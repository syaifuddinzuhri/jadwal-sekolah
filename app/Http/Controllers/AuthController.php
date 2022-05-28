<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            return redirect()->route('auth.showLogin')->with('error', 'Email tidak ditemukan!');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('auth.showLogin')->with('error', 'Password salah!');
        }

        if (Auth::loginUsingId($user->id)) {
            $user = Auth::user();
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('auth.showLogin')->with('error', 'Login gagal. Silahkan ulangi beberapa saat lagi!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.showLogin');
    }
}
