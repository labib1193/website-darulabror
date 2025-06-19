<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:user,admin,superadmin',
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
            // Ensure directory exists
            if (!Storage::disk('public')->exists('profile_photos')) {
                Storage::disk('public')->makeDirectory('profile_photos');
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $userData['profile_photo'] = $path;
            $userData['profile_photo_original'] = $file->getClientOriginalName();
            $userData['profile_photo_uploaded_at'] = now();
        }        // Handle email verification
        if ($request->has('email_verified')) {
            $userData['email_verified_at'] = now();
        }

        User::create($userData);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }
    public function show(User $user)
    {
        $user->load(['identitas', 'orangtua', 'dokumen', 'pembayaran']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin,superadmin',
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
            // Ensure directory exists
            if (!Storage::disk('public')->exists('profile_photos')) {
                Storage::disk('public')->makeDirectory('profile_photos');
            }

            // Delete old photo if exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profile_photos', $filename, 'public');
            $userData['profile_photo'] = $path;
            $userData['profile_photo_original'] = $file->getClientOriginalName();
            $userData['profile_photo_uploaded_at'] = now();
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
        // Prevent deleting superadmin users
        if ($user->role === 'superadmin') {
            return redirect()->route('admin.users.index')->with('error', 'Super Admin tidak dapat dihapus.');
        }

        // Prevent self-deletion
        if (Auth::user()->id === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Delete profile photo if exists
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
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
     */
    public function resetPassword(User $user)
    {
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
}
