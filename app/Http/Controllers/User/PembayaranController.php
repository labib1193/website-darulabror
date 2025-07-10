<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all payments for the user using the 'pembayaran' relationship
        $pembayaran = Pembayaran::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pembayaran', compact('pembayaran'));
    }

    public function store(Request $request)
    {
        $validationRules = [
            'jenis_pembayaran' => 'required|in:pendaftaran,spp_bulanan,seragam,ujian,kitab,kegiatan,lainnya',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nominal' => 'required|numeric|min:1000',
            'tanggal_transfer' => 'required|date|before_or_equal:today',
            'bank_pengirim' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ];

        // Add validation for custom payments
        if ($request->jenis_pembayaran === 'lainnya') {
            $validationRules['deskripsi_custom'] = 'required|string|max:255';
            $validationRules['jumlah_custom'] = 'required|numeric|min:1000';
        }

        $request->validate($validationRules, [
            'jenis_pembayaran.required' => 'Jenis pembayaran harus dipilih.',
            'jenis_pembayaran.in' => 'Jenis pembayaran tidak valid.',
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diupload.',
            'bukti_pembayaran.image' => 'File harus berupa gambar.',
            'bukti_pembayaran.mimes' => 'Format file harus JPG, PNG, atau JPEG.',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB.',
            'nominal.required' => 'Nominal transfer harus diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'nominal.min' => 'Nominal minimal Rp 1.000.',
            'tanggal_transfer.required' => 'Tanggal transfer harus diisi.',
            'tanggal_transfer.before_or_equal' => 'Tanggal transfer tidak boleh lebih dari hari ini.',
            'bank_pengirim.required' => 'Bank pengirim harus diisi.',
            'nama_pengirim.required' => 'Nama pengirim harus diisi.',
            'deskripsi_custom.required' => 'Deskripsi pembayaran harus diisi.',
            'jumlah_custom.required' => 'Jumlah tagihan harus diisi.',
            'jumlah_custom.min' => 'Jumlah tagihan minimal Rp 1.000.',
        ]);

        try {
            $user = Auth::user();

            // Check if payment for this type already exists and not rejected
            $existingPayment = Pembayaran::where('user_id', $user->id)
                ->where('jenis_pembayaran', $request->jenis_pembayaran)
                ->whereIn('status_verifikasi', ['pending', 'approved'])
                ->first();

            if ($existingPayment) {
                return redirect()->back()
                    ->with('error', 'Anda sudah memiliki pembayaran untuk jenis "' . $request->jenis_pembayaran . '" yang sedang diproses atau sudah disetujui.');
            }

            // Get payment details based on type
            if ($request->jenis_pembayaran === 'lainnya') {
                $jumlahTagihan = $request->jumlah_custom;
                $deskripsi = $request->deskripsi_custom;
            } else {
                $paymentDetails = $this->getPaymentDetails($request->jenis_pembayaran);
                $jumlahTagihan = $paymentDetails['jumlah'];
                $deskripsi = $paymentDetails['deskripsi'];
            }

            // Handle file upload to Cloudinary
            $file = $request->file('bukti_pembayaran');
            $originalName = $file->getClientOriginalName();

            try {
                // Upload to Cloudinary menggunakan API yang lebih reliable
                $publicId = 'pembayaran/user_' . $user->id . '_bukti_' . time();

                $cloudinary = new \Cloudinary\Cloudinary();
                $uploadResult = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                    'public_id' => $publicId,
                    'folder' => 'pembayaran',
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]);

                $filePath = $uploadResult['secure_url'];
            } catch (\Exception $e) {
                Log::error('Cloudinary upload failed for bukti pembayaran: ' . $e->getMessage(), [
                    'user_id' => $user->id,
                    'file_name' => $file->getClientOriginalName(),
                    'error' => $e->getMessage()
                ]);
                return redirect()->back()
                    ->with('error', 'Gagal mengupload bukti pembayaran. Silakan coba lagi.')
                    ->withInput();
            }

            // Create pembayaran record with transaction to ensure unique code
            $pembayaran = DB::transaction(function () use ($request, $user, $jumlahTagihan, $deskripsi, $filePath, $originalName) {
                // Generate payment code inside transaction
                $kodePembayaran = Pembayaran::generateKodePembayaran($request->jenis_pembayaran);

                return Pembayaran::create([
                    'user_id' => $user->id,
                    'kode_pembayaran' => $kodePembayaran,
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'jumlah_tagihan' => $jumlahTagihan,
                    'deskripsi' => $deskripsi,
                    'bukti_pembayaran' => $filePath,
                    'nominal' => $request->nominal,
                    'tanggal_transfer' => $request->tanggal_transfer,
                    'bank_pengirim' => $request->bank_pengirim,
                    'nama_pengirim' => $request->nama_pengirim,
                    'keterangan' => $request->keterangan,
                    'status_verifikasi' => 'pending',
                    'status_pembayaran' => 'pending',
                    'bukti_pembayaran_original' => $originalName,
                    'bukti_pembayaran_uploaded_at' => now(),
                ]);
            });

            return redirect()->route('user.pembayaran')
                ->with('success', 'Bukti pembayaran berhasil diupload dengan kode: ' . $pembayaran->kode_pembayaran . '. Menunggu verifikasi admin dalam 1x24 jam.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupload bukti pembayaran: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function getPaymentDetails($jenisPembayaran)
    {
        return match ($jenisPembayaran) {
            'pendaftaran' => [
                'jumlah' => 500000,
                'deskripsi' => 'Biaya pendaftaran siswa baru'
            ],
            'spp_bulanan' => [
                'jumlah' => 300000,
                'deskripsi' => 'Biaya SPP bulanan'
            ],
            'seragam' => [
                'jumlah' => 750000,
                'deskripsi' => 'Seragam sekolah lengkap'
            ],
            'ujian' => [
                'jumlah' => 250000,
                'deskripsi' => 'Buku & Alat Tulis'
            ],
            'kitab' => [
                'jumlah' => 250000,
                'deskripsi' => 'Kitab-kitab Pelajaran'
            ],
            'kegiatan' => [
                'jumlah' => 100000,
                'deskripsi' => 'Biaya kegiatan pondok'
            ],
            default => [
                'jumlah' => 0,
                'deskripsi' => 'Pembayaran lainnya'
            ]
        };
    }

    public function download($id)
    {
        $pembayaran = Pembayaran::where('user_id', Auth::id())->findOrFail($id);

        if (!$pembayaran->bukti_pembayaran) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = $pembayaran->bukti_pembayaran;

        // Check if it's a Cloudinary URL
        if (filter_var($filePath, FILTER_VALIDATE_URL)) {
            // For Cloudinary URLs, redirect to the URL for download
            return redirect($filePath);
        }

        // For local storage files
        if (!Storage::disk('public')->exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }

        $localPath = storage_path('app/public/' . $filePath);
        $fileName = $pembayaran->bukti_pembayaran_original ?: 'bukti_pembayaran.jpg';

        return response()->download($localPath, $fileName);
    }

    public function delete($id)
    {
        try {
            $pembayaran = Pembayaran::where('user_id', Auth::id())->findOrFail($id);

            // Only allow deletion if status is pending or rejected
            if (!in_array($pembayaran->status_verifikasi, ['pending', 'rejected'])) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus pembayaran yang sudah disetujui.');
            }

            // Delete file from Cloudinary or local storage
            if ($pembayaran->bukti_pembayaran) {
                $this->deletePaymentFile($pembayaran->bukti_pembayaran);
            }

            $pembayaran->delete();

            return redirect()->route('user.pembayaran')
                ->with('success', 'Data pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data pembayaran.');
        }
    }

    /**
     * Delete payment file from Cloudinary or local storage
     */
    private function deletePaymentFile(?string $filePath): void
    {
        if (!$filePath) {
            return;
        }

        try {
            // Check if it's a Cloudinary URL
            if (filter_var($filePath, FILTER_VALIDATE_URL) && str_contains($filePath, 'cloudinary.com')) {
                // Extract public_id from Cloudinary URL
                $publicId = $this->extractPublicIdFromCloudinaryUrl($filePath);
                if ($publicId) {
                    Cloudinary::destroy($publicId);
                }
            } else {
                // Delete local storage file
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to delete payment file: ' . $e->getMessage());
        }
    }

    /**
     * Extract public_id from Cloudinary URL
     */
    private function extractPublicIdFromCloudinaryUrl(string $url): ?string
    {
        try {
            $parsedUrl = parse_url($url);
            $pathParts = explode('/', $parsedUrl['path']);

            // Find the index after version (v1234567890)
            $versionIndex = null;
            foreach ($pathParts as $index => $part) {
                if (preg_match('/^v\d+$/', $part)) {
                    $versionIndex = $index;
                    break;
                }
            }

            if ($versionIndex !== null) {
                // Get path parts after version
                $publicIdParts = array_slice($pathParts, $versionIndex + 1);
                $publicId = implode('/', $publicIdParts);

                // Remove file extension
                $publicId = preg_replace('/\.[^.]*$/', '', $publicId);

                return $publicId;
            }
        } catch (\Exception $e) {
            Log::error('Failed to extract public_id from Cloudinary URL: ' . $e->getMessage());
        }

        return null;
    }
}
