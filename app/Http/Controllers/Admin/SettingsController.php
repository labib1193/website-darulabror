<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    /**
     * Display admin settings page
     */
    public function index()
    {
        $admin = Auth::user();
        return view('admin.settings', compact('admin'));
    }

    /**
     * Update admin profile information
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);
        $admin = User::find(Auth::id());
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update admin password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);
        $admin = User::find(Auth::id());

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }
}
