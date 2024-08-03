<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function store(AuthRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        if ($request->user()->role === 'Gudang') {
            session()->flash('success', 'Berhasil masuk aplikasi');
            return redirect()->intended(RouteServiceProvider::GUDANG);
        } else if ($request->user()->role === 'Manajer') {
            session()->flash('success', 'Berhasil masuk aplikasi');
            return redirect()->intended(RouteServiceProvider::MANAJER);
        } else if ($request->user()->role === 'Administrator') {
            Auth::logout();
            session()->flash('error', "Login untuk admin tidak diizinkan di halaman ini.");
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->flash('success', 'Berhasil keluar aplikasi');
        return redirect('/login');
    }
}
