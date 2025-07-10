<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserController extends Controller
{
    public function index()
    {
        // Cek role user yang sedang login
        $currentUser = Auth::user();

        if ($currentUser->role === 'superadmin') {
            // Superadmin bisa melihat semua user (user, admin, superadmin)
            $users = User::latest()->paginate(10);
        } else {
            // Admin hanya bisa melihat user biasa saja
            $users = User::where('role', 'user')->latest()->paginate(10);
        }

        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        // Tentukan role yang tersedia berdasarkan user yang login
        $currentUser = Auth::user();
        $availableRoles = [];

        if ($currentUser->role === 'superadmin') {
            $availableRoles = ['user', 'admin', 'superadmin'];
        } else {
            // Admin hanya bisa membuat user biasa
            $availableRoles = ['user'];
        }

        return view('admin.users.create', compact('availableRoles'));
    }
    public function store(Request $request)
    {
        // Tentukan role yang diizinkan berdasarkan user yang login
        $currentUser = Auth::user();
        $allowedRoles = [];

        if ($currentUser->role === 'superadmin') {
            $allowedRoles = ['user', 'admin', 'superadmin'];
        } else {
            // Admin hanya bisa membuat user biasa
            $allowedRoles = ['user'];
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:' . implode(',', $allowedRoles),
            'status' => 'required|in:active,inactive',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $originalName = $file->getClientOriginalName();

            try {
                // Upload to Cloudinary
                $uploadResult = Cloudinary::upload($file->getRealPath(), [
                    'folder' => 'profile_photos',
                    'public_id' => 'admin_user_' . time() . '_profile',
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]);

                $userData['profile_photo'] = $uploadResult->getSecurePath();
                $userData['profile_photo_original'] = $originalName;
                $userData['profile_photo_uploaded_at'] = now();
            } catch (\Exception $e) {
                Log::error('Cloudinary upload failed for profile photo: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Gagal mengupload foto profil. Silakan coba lagi.')
                    ->withInput();
            }
        }        // Handle email verification
        if ($request->has('email_verified')) {
            $userData['email_verified_at'] = now();
        }

        User::create($userData);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }
    public function show(User $user)
    {
        // Cek apakah admin dapat melihat detail user ini
        $currentUser = Auth::user();

        if ($currentUser->role !== 'superadmin') {
            // Admin hanya bisa melihat detail user biasa, tidak bisa melihat admin/superadmin lain
            if ($user->role !== 'user') {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Anda tidak memiliki izin untuk melihat detail user dengan role ' . $user->role);
            }
        }

        $user->load(['identitas', 'orangtua', 'dokumen', 'pembayaran']);
        return view('admin.users.show', compact('user'));
    }
    public function edit(User $user)
    {
        // Cek apakah admin dapat mengedit user ini
        $currentUser = Auth::user();

        if ($currentUser->role !== 'superadmin') {
            // Admin hanya bisa edit user biasa, tidak bisa edit admin/superadmin lain
            if ($user->role !== 'user') {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Anda tidak memiliki izin untuk mengedit user dengan role ' . $user->role);
            }
        }

        // Tentukan role yang tersedia berdasarkan user yang login
        $availableRoles = [];
        if ($currentUser->role === 'superadmin') {
            $availableRoles = ['user', 'admin', 'superadmin'];
        } else {
            // Admin hanya bisa mengubah role ke user
            $availableRoles = ['user'];
        }

        return view('admin.users.edit', compact('user', 'availableRoles'));
    }
    public function update(Request $request, User $user)
    {
        // Cek apakah admin dapat mengupdate user ini
        $currentUser = Auth::user();

        if ($currentUser->role !== 'superadmin') {
            // Admin hanya bisa update user biasa, tidak bisa update admin/superadmin lain
            if ($user->role !== 'user') {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Anda tidak memiliki izin untuk mengupdate user dengan role ' . $user->role);
            }
        }

        // Tentukan role yang diizinkan berdasarkan user yang login
        $allowedRoles = [];
        if ($currentUser->role === 'superadmin') {
            $allowedRoles = ['user', 'admin', 'superadmin'];
        } else {
            // Admin hanya bisa mengubah role ke user
            $allowedRoles = ['user'];
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:' . implode(',', $allowedRoles),
            'status' => 'required|in:active,inactive',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Handle password update if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $originalName = $file->getClientOriginalName();

            try {
                // Delete old photo if exists
                if ($user->profile_photo) {
                    $this->deleteOldProfilePhoto($user->profile_photo);
                }

                // Upload to Cloudinary
                $uploadResult = Cloudinary::upload($file->getRealPath(), [
                    'folder' => 'profile_photos',
                    'public_id' => 'admin_user_' . $user->id . '_profile',
                    'overwrite' => true,
                    'resource_type' => 'image',
                ]);

                $userData['profile_photo'] = $uploadResult->getSecurePath();
                $userData['profile_photo_original'] = $originalName;
                $userData['profile_photo_uploaded_at'] = now();
            } catch (\Exception $e) {
                Log::error('Cloudinary upload failed for profile photo: ' . $e->getMessage());
                return redirect()->back()
                    ->with('error', 'Gagal mengupload foto profil. Silakan coba lagi.')
                    ->withInput();
            }
        }        // Handle email verification
        if ($request->has('email_verified')) {
            $userData['email_verified_at'] = now();
        } else {
            $userData['email_verified_at'] = null;
        }

        $user->update($userData);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
    }
    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        // Prevent deleting superadmin users
        if ($user->role === 'superadmin') {
            return redirect()->route('admin.users.index')->with('error', 'Super Admin tidak dapat dihapus.');
        }

        // Prevent self-deletion
        if ($currentUser->id === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Admin hanya bisa menghapus user biasa, tidak bisa menghapus admin lain
        if ($currentUser->role !== 'superadmin' && $user->role !== 'user') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus user dengan role ' . $user->role);
        }

        // Delete profile photo if exists
        if ($user->profile_photo) {
            $this->deleteOldProfilePhoto($user->profile_photo);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Update user status (activate/deactivate)
     */
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $user->update(['status' => $request->status]);

        $statusText = $request->status === 'active' ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.users.index')
            ->with('success', "User berhasil {$statusText}.");
    }

    /**
     * Reset user password
     */    public function resetPassword(User $user)
    {
        $currentUser = Auth::user();

        // Admin hanya bisa reset password user biasa, tidak bisa reset admin/superadmin lain
        if ($currentUser->role !== 'superadmin' && $user->role !== 'user') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak memiliki izin untuk reset password user dengan role ' . $user->role);
        }

        $newPassword = 'password123'; // Default password
        $user->update([
            'password' => Hash::make($newPassword),
            'password_changed_at' => now()
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Password user berhasil direset ke: {$newPassword}");
    }

    /**
     * Verify user email
     */
    public function verifyEmail(User $user)
    {
        if ($user->email_verified_at) {
            return redirect()->route('admin.users.index')
                ->with('info', 'Email user sudah terverifikasi sebelumnya.');
        }

        $user->update(['email_verified_at' => now()]);

        return redirect()->route('admin.users.index')
            ->with('success', "Email {$user->email} berhasil diverifikasi.");
    }

    /**
     * Unverify user email
     */
    public function unverifyEmail(User $user)
    {
        if (!$user->email_verified_at) {
            return redirect()->route('admin.users.index')
                ->with('info', 'Email user belum terverifikasi.');
        }

        $user->update(['email_verified_at' => null]);

        return redirect()->route('admin.users.index')
            ->with('success', "Verifikasi email {$user->email} berhasil dibatalkan.");
    }

    /**
     * Bulk verify emails
     */
    public function bulkVerifyEmails(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $count = User::whereIn('id', $request->user_ids)
            ->whereNull('email_verified_at')
            ->update(['email_verified_at' => now()]);

        return redirect()->route('admin.users.index')
            ->with('success', "{$count} email berhasil diverifikasi secara bulk.");
    }

    /**
     * Delete old profile photo from storage or Cloudinary
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
