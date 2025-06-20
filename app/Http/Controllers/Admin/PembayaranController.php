<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['user', 'user.identitas'])->latest();

        // Filter by status if requested
        if ($request->has('status') && $request->status != '') {
            $query->where('status_verifikasi', $request->status);
        }

        // Filter by date range if requested
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('tanggal_transfer', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('tanggal_transfer', '<=', $request->end_date);
        }

        // Search by user name or email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $pembayaran = $query->paginate(10);

        // Statistics for dashboard
        $stats = [
            'total' => Pembayaran::count(),
            'pending' => Pembayaran::where('status_verifikasi', 'pending')->count(),
            'approved' => Pembayaran::where('status_verifikasi', 'approved')->count(),
            'rejected' => Pembayaran::where('status_verifikasi', 'rejected')->count(),
        ];

        return view('admin.pembayaran.index', compact('pembayaran', 'stats'));
    }
    public function create()
    {
        $users = User::where('role', 'user')->where('status', 'active')->get();
        return view('admin.pembayaran.create', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_pembayaran' => 'required|in:pendaftaran,spp_bulanan,ujian,kitab,seragam,kegiatan,lainnya',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'nominal' => 'required|numeric|min:0',
            'bank_pengirim' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'status_pembayaran' => 'required|in:belum_bayar,pending,lunas,gagal',
            'tanggal_transfer' => 'required|date',
            'batas_pembayaran' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        // Create payment record with transaction to ensure unique code
        $pembayaran = DB::transaction(function () use ($request) {
            // Generate payment code inside transaction
            $kodePembayaran = Pembayaran::generateKodePembayaran($request->jenis_pembayaran);

            $data = $request->all();
            $data['kode_pembayaran'] = $kodePembayaran;
            $data['verified_by'] = Auth::id();
            $data['verified_at'] = now();

            return Pembayaran::create($data);
        });

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil ditambahkan dengan kode: ' . $pembayaran->kode_pembayaran);
    }

    public function show(Pembayaran $pembayaran)
    {
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        return view('admin.pembayaran.edit', compact('pembayaran'));
    }
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'jenis_pembayaran' => 'required|in:pendaftaran,spp_bulanan,ujian,kitab,seragam,kegiatan,lainnya',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'nominal' => 'required|numeric|min:0',
            'bank_pengirim' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'status_pembayaran' => 'required|in:belum_bayar,pending,lunas,gagal',
            'tanggal_transfer' => 'required|date',
            'batas_pembayaran' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        // Update verification info if status changed
        if ($request->status_verifikasi !== $pembayaran->status_verifikasi) {
            $data['verified_by'] = Auth::id();
            $data['verified_at'] = now();
        }

        // Auto-update status_pembayaran based on status_verifikasi
        if ($request->status_verifikasi === 'approved') {
            $data['status_pembayaran'] = 'lunas';
        } elseif ($request->status_verifikasi === 'rejected') {
            $data['status_pembayaran'] = 'gagal';
        }

        $pembayaran->update($data);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil diupdate.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        // Delete file if exists
        if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->delete();
        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
    /**
     * Approve payment
     */
    public function approve(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status_verifikasi' => 'approved',
            'status_pembayaran' => 'lunas',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'keterangan' => 'Pembayaran disetujui oleh admin'
        ]);

        return redirect()->back()->with('success', 'Pembayaran ' . $pembayaran->kode_pembayaran . ' berhasil disetujui.');
    }
    /**
     * Reject payment
     */
    public function reject(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'keterangan' => 'required|string|max:500'
        ]);

        $pembayaran->update([
            'status_verifikasi' => 'rejected',
            'status_pembayaran' => 'gagal',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Pembayaran ' . $pembayaran->kode_pembayaran . ' berhasil ditolak.');
    }

    /**
     * Download payment proof
     */
    public function download(Pembayaran $pembayaran)
    {
        if (!$pembayaran->bukti_pembayaran || !Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            return redirect()->back()->with('error', 'File bukti pembayaran tidak ditemukan.');
        }

        return response()->download(
            storage_path('app/public/' . $pembayaran->bukti_pembayaran),
            $pembayaran->bukti_pembayaran_original ?? 'bukti_pembayaran_' . $pembayaran->id . '.jpg'
        );
    }

    /**
     * Bulk actions for payments
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'payment_ids' => 'required|array',
            'payment_ids.*' => 'exists:pembayaran,id',
            'keterangan' => 'required_if:action,reject|string|max:500'
        ]);

        $paymentIds = $request->payment_ids;
        $action = $request->action;
        $keterangan = $request->keterangan;

        switch ($action) {
            case 'approve':
                Pembayaran::whereIn('id', $paymentIds)
                    ->update([
                        'status_verifikasi' => 'approved',
                        'verified_by' => Auth::id(),
                        'verified_at' => now(),
                        'keterangan' => 'Pembayaran disetujui secara bulk oleh admin'
                    ]);
                return redirect()->back()->with('success', count($paymentIds) . ' pembayaran berhasil disetujui.');

            case 'reject':
                Pembayaran::whereIn('id', $paymentIds)
                    ->update([
                        'status_verifikasi' => 'rejected',
                        'verified_by' => Auth::id(),
                        'verified_at' => now(),
                        'keterangan' => $keterangan
                    ]);
                return redirect()->back()->with('success', count($paymentIds) . ' pembayaran berhasil ditolak.');

            case 'delete':
                $payments = Pembayaran::whereIn('id', $paymentIds)->get();
                foreach ($payments as $payment) {
                    if ($payment->bukti_pembayaran && Storage::disk('public')->exists($payment->bukti_pembayaran)) {
                        Storage::disk('public')->delete($payment->bukti_pembayaran);
                    }
                    $payment->delete();
                }
                return redirect()->back()->with('success', count($paymentIds) . ' pembayaran berhasil dihapus.');
        }
    }

    /**
     * Update payment status
     */
    public function updateStatus(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'keterangan' => 'nullable|string|max:500'
        ]);

        $pembayaran->update([
            'status_verifikasi' => $request->status_verifikasi,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
            'keterangan' => $request->keterangan
        ]);

        $statusText = match ($request->status_verifikasi) {
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
            'pending' => 'dikembalikan ke status pending'
        };

        return redirect()->back()->with('success', "Status pembayaran berhasil {$statusText}.");
    }
}
