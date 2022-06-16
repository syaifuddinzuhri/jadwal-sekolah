<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        if ($request->role == 'admin') {
            $admin = Admin::where('email', $request->email)->first();
            if (empty($admin)) {
                return redirect()->route('auth.showLogin')->with('error', 'Email tidak ditemukan!');
            }

            if (!Hash::check($request->password, $admin->password)) {
                return redirect()->route('auth.showLogin')->with('error', 'Password salah!');
            }

            if (Auth::guard('admin')->loginUsingId($admin->id)) {
                $admin = Auth::guard('admin')->user();
                return redirect()->route('dashboard.index');
            }
        }

        if ($request->role == 'guru') {
            $guru = Guru::where('email', $request->email)->first();
            if (empty($guru)) {
                return redirect()->route('auth.showLogin')->with('error', 'Email tidak ditemukan!');
            }

            if (!Hash::check($request->password, $guru->password)) {
                return redirect()->route('auth.showLogin')->with('error', 'Password salah!');
            }

            if (Auth::guard('guru')->loginUsingId($guru->id)) {
                $guru = Auth::guard('guru')->user();
                return redirect()->route('guru.home');
            }
        }


        return redirect()->route('auth.showLogin')->with('error', 'Login gagal. Silahkan ulangi beberapa saat lagi!');
    }

    public function adminlogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.showLogin');
    }

    public function gurulogout(Request $request)
    {
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.showLogin');
    }
}
