<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PengaturanController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();
        $identitas = $user->identitas;

        return view('user.pengaturanakun', compact('user', 'identitas'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'telepon' => 'nullable|string|max:20',
        ], [
            'nama.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'telepon.max' => 'No. telepon maksimal 20 karakter.',
        ]);

        try {
            /** @var User $user */
            $user = Auth::user();

            // Update user table
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);

            // Update or create identitas table
            $identitas = $user->identitas;
            if ($identitas) {
                $identitas->update([
                    'no_hp' => $request->telepon,
                ]);
            } else {
                Identitas::create([
                    'user_id' => $user->id,
                    'no_hp' => $request->telepon,
                ]);
            }

            return redirect()->route('user.pengaturanakun')
                ->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil.')
                ->withInput();
        }
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => ['required', 'confirmed', Password::min(6)],
        ], [
            'password_lama.required' => 'Password lama harus diisi.',
            'password_baru.required' => 'Password baru harus diisi.',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_baru.min' => 'Password minimal 6 karakter.',
        ]);

        try {
            /** @var User $user */
            $user = Auth::user();

            // Check if old password is correct
            if (!Hash::check($request->password_lama, $user->password)) {
                return redirect()->back()
                    ->with('error', 'Password lama tidak benar.');
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->password_baru),
            ]);

            return redirect()->route('user.pengaturanakun')
                ->with('success', 'Password berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengubah password.');
        }
    }

    public function updateProfilePhoto(Request $request): RedirectResponse
    {
        // Validasi file upload
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'foto_profil.required' => 'Foto profil harus dipilih.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format file harus JPG, PNG, atau JPEG.',
            'foto_profil.max' => 'Ukuran file maksimal 1MB.',
        ]);

        try {
            /** @var User $user */
            $user = Auth::user();

            if (!$user) {
                Log::error('User not found during profile photo upload');
                return redirect()->back()
                    ->with('error', 'User tidak ditemukan.');
            }

            $file = $request->file('foto_profil');

            if (!$file) {
                Log::error('File not found in request during profile photo upload');
                return redirect()->back()
                    ->with('error', 'File tidak ditemukan.');
            }

            Log::info('Starting profile photo upload', [
                'user_id' => $user->id,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ]);

            // Check if Cloudinary is properly configured
            if (empty(config('cloudinary.cloud_url'))) {
                Log::error('Cloudinary not configured properly', [
                    'cloud_url' => config('cloudinary.cloud_url'),
                    'notification_url' => config('cloudinary.notification_url')
                ]);
                return redirect()->back()
                    ->with('error', 'Cloudinary configuration missing. Please contact administrator.');
            }

            $originalName = $file->getClientOriginalName();

            // Delete old profile photo if exists
            if ($user->profile_photo) {
                Log::info('Deleting old profile photo', ['old_photo' => $user->profile_photo]);
                $this->deleteOldProfilePhoto($user->profile_photo);
            }

            // Upload ke Cloudinary dengan folder profile_photos dan public_id sesuai user ID
            Log::info('Attempting Cloudinary upload');

            try {
                $cloudinary = new \Cloudinary\Cloudinary();
                $uploadResult = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                    'folder' => 'profile_photos',
                    'public_id' => 'user_' . $user->id . '_profile_' . time(),
                    'overwrite' => true,
                    'resource_type' => 'image',
                    'quality' => 'auto',
                    'fetch_format' => 'auto'
                ]);

                Log::info('Cloudinary upload successful', ['upload_result' => $uploadResult]);

                $secureUrl = $uploadResult['secure_url'];
            } catch (\Exception $e) {
                Log::error('Cloudinary upload exception: ' . $e->getMessage(), [
                    'user_id' => $user->id,
                    'file_name' => $file->getClientOriginalName(),
                    'error' => $e->getMessage()
                ]);
                throw new \Exception('Upload failed: ' . $e->getMessage());
            }

            Log::info('Secure URL obtained', ['secure_url' => $secureUrl]);

            // Update user record dengan URL Cloudinary
            $user->update([
                'profile_photo' => $secureUrl,
                'profile_photo_original' => $originalName,
                'profile_photo_uploaded_at' => now(),
            ]);

            Log::info('Profile photo updated successfully', ['user_id' => $user->id]);

            return redirect()->back()
                ->with('success', 'Foto profil berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Profile photo upload error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupload foto profil. Silakan coba lagi.');
        }
    }

    public function deleteAccount(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ], [
            'password.required' => 'Password harus diisi untuk menghapus akun.',
        ]);

        try {
            /** @var User $user */
            $user = Auth::user();

            // Check password
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()
                    ->with('error', 'Password tidak benar.');
            }

            // Delete profile photo if exists
            if ($user->profile_photo) {
                // Check if it's a Cloudinary URL
                if (str_starts_with($user->profile_photo, 'https://res.cloudinary.com')) {
                    try {
                        // Extract public_id from URL for deletion
                        $publicId = 'profile_photos/user_' . $user->id . '_profile';
                        Cloudinary::destroy($publicId);
                    } catch (\Exception $e) {
                        // Log error but don't stop the deletion process
                        Log::warning('Failed to delete Cloudinary image: ' . $e->getMessage());
                    }
                } else {
                    // Legacy: Delete from local storage
                    if (Storage::disk('public')->exists($user->profile_photo)) {
                        Storage::disk('public')->delete($user->profile_photo);
                    }
                }
            }

            // Logout and delete user (cascade will delete related data)
            Auth::logout();
            $user->delete();

            return redirect()->route('user.auth.login')
                ->with('success', 'Akun berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus akun.');
        }
    }

    /**
     * Delete old profile photo from Cloudinary or local storage
     */
    private function deleteOldProfilePhoto(?string $filePath): void
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
            Log::error('Failed to delete old profile photo: ' . $e->getMessage());
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
