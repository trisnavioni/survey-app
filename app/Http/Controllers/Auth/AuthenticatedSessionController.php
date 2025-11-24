<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login custom.
     */
    public function create(): View
    {
        return view('auth.custom-login');
    }

    /**
     * Proses login user.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi format input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('login_error', 'EMAIL_TIDAK_TERDAFTAR');
        }

        // Email ada -> cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('login_error', 'PASSWORD_SALAH');
        }

        // Cek role admin
        if ($user->role !== 'admin') {
            return redirect()->back()->with('login_error', 'BUKAN_ADMIN');
        }

        // Semua benar -> login
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect ke dashboard berdasarkan slug
        if ($user->slug) {
            return redirect()->route('admin.personal.dashboard', ['slug' => $user->slug]);
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout kembali ke halaman utama
        return redirect()->route('halaman.utama');
    }
}
