<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // redirect حسب الدور
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect()->intended(route('units.index')); // أو لوحة الادارة
        }
        if ($role === 'supervisor') {
            return redirect()->intended(route('units.index')); // نفس صفحة الوحدات
        }
        // sales
        return redirect()->intended(route('units.index'));
    }

    return back()->withErrors([
        'email' => 'بيانات الدخول غير صحيحة.',
    ])->withInput();
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
