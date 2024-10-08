<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        $role = Auth::user()->role; // Ganti 'role' dengan nama field yang sesuai dalam tabel user Anda
    
        if ($role === 'admin') {
            return redirect('admin-home');
        }else if ($role === 'karyawan') {
            return redirect('karyawan-home');
        }else if ($role === 'akuntan') {
            return redirect('akuntan-home');
        }else if ($role === 'sales') {
            return redirect('sales-home');
        }else if ($role === 'kepalaGudang') {
            return redirect('gudang-home');
        }
    
        return redirect()->intended(route('dashboard'));
    }
    
    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
