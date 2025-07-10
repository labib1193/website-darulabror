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
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ], [
            'foto_profil.required' => 'Foto profil harus dipilih.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format file harus JPG, PNG.',
            'foto_profil.max' => 'Ukuran file maksimal 1MB.',
        ]);

        try {
            /** @var User $user */
            $user = Auth::user();

            // Delete old profile photo if exists
            // if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            //     Storage::disk('public')->delete($user->profile_photo);
            // }

            // Upload new profile photo
            // $file = $request->file('foto_profil');
            // $originalName = $file->getClientOriginalName();
            // $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            // $filePath = $file->storeAs('profile_photos', $fileName, 'public');
            $file = $request->file('foto_profil');
            $upload = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'profile_photos',
                'public_id' => 'user_' . $user->id . '_profile',
                'overwrite' => true,
            ]);

            $secureUrl = $upload->getSecurePath();
            $originalName = $file->getClientOriginalName();

            $user->update([
                'profile_photo' => $secureUrl,
                'profile_photo_original' => $originalName,
                'profile_photo_uploaded_at' => now(),
            ]);

            // Update user record
            // $user->update([
            //     'profile_photo' => $filePath,
            //     'profile_photo_original' => $originalName,
            //     'profile_photo_uploaded_at' => now(),
            // ]);

            return redirect()->route('user.pengaturanakun')
                ->with('success', 'Foto profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupload foto profil.');
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
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
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
}
