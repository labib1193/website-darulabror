<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin(Request $request)
    {
        // Backup check: jika user sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }

        // Check if user came from expired session
        $message = null;
        if ($request->has('expired') || $request->session()->has('auth_expired')) {
            $message = 'Sesi Anda telah berakhir. Silakan login kembali.';
            $request->session()->forget('auth_expired');
        }

        return view('user.auth.login', compact('message'));
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        // Backup check: jika user sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }

        return view('user.auth.register');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect ke dashboard user
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('user.auth.login')
                ->with('success', 'Pendaftaran berhasil! Silakan login.');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'
            ])->withInput();
        }
    }
    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.auth.login')->with('success', 'Anda telah berhasil logout.');
    }
}
