<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginUser extends Component
{
    #[Validate]
    public $email, $password, $remember;

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    public function mount()
    {
        // Optionally prefill email and password for testing
        $this->email = 'admin@example.com';
        $this->password = 'garuda7';
    }

    public function user_login()
    {
        // Validate the form data
        $this->validate();

        // Handle "remember me" checkbox
        $remember = !empty($this->remember);

        // Check if the user exists
        if (!User::where('email', $this->email)->exists()) {
            return redirect('/login')->with([
                'error' => [
                    "title" => "Email tidak terdaftar!",
                ]
            ]);
        }

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $remember)) {
            $user = Auth::user();

            // If the user has an "admin" role, redirect to admin dashboard
            if ($user->hasRole('admin')) {
                return redirect()->intended('admin/dashboard')->with([
                    'success' => [
                        "title" => "Berhasil masuk sebagai admin",
                    ]
                ]);
            }

            // If the user has a "user" role, redirect to user dashboard
            if ($user->hasRole('user')) {
                return redirect()->intended('user/dashboard')->with([
                    'success' => [
                        "title" => "Berhasil masuk sebagai user",
                    ]
                ]);
            }

            // If the user role is not valid, log out the user
            Auth::logout();
            return redirect('/login')->with([
                'error' => [
                    "title" => "Akun Anda tidak memiliki role yang valid.",
                ]
            ]);
        }

        // Handle invalid login attempts
        return redirect('/login')->with([
            'error' => [
                "title" => "Email atau password salah!",
            ]
        ]);
    }

    public function render()
    {
        return view('livewire.login-user');
    }
}
