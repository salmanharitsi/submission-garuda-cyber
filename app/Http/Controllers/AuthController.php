<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function get_login_page()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->intended('user/dashboard');
            }

            Auth::logout();
            return redirect('/login')->with('error', 'Akun Anda tidak memiliki role yang valid.');
        }

        return view('auth.login');
    }

    public function get_register_page()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }

        return view('auth.register');
    }

    public function logout_page()
    {
        Auth::logout();
        return redirect(url('/login'))->with([
            'success' => [
                "title" => "Berhasil keluar",
            ]
        ]);
    }

    private function redirectBasedOnRole($user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->intended('admin/dashboard');
        } elseif ($user->hasRole('user')) {
            return redirect()->intended('user/dashboard');
        }

        Auth::logout();
        return redirect('/login')->with('error', 'Akun Anda tidak memiliki role yang valid.');
    }
}