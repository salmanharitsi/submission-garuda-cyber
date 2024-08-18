<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RegisterUser extends Component
{
    #[Validate]
    public $name, $email, $password, $confirm_password, $referral_code;

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'confirm_password' => 'required_with:password|same:password',
            'referral_code' => 'nullable|exists:users,referral_code',
        ];
    }

    public function user_register()
    {
        // Validate the form data
        $validatedData = $this->validate();

        // Create a new user
        $user = new User();
        $user->name = ucwords(strtolower(trim($validatedData['name'])));
        $user->email = $validatedData['email'];
        $user->referral_code = Str::random(10);
        $user->password = Hash::make($validatedData['password']);
        $user->remember_token = Str::uuid()->toString();
        $user->email_verified_at = now();
        $user->points = 0; // Set initial points for the new user

        $user->save(); // Save the user before handling referrals

        // Handle referral logic
        if (!empty($validatedData['referral_code'])) {
            $referrer = User::where('referral_code', $validatedData['referral_code'])->first();

            // Only proceed if the referrer is found
            if ($referrer) {
                $points = 50; // Define the points to be added

                // Create a new referral record
                Referral::create([
                    'referrer_id' => $referrer->id,
                    'referred_id' => $user->id,
                    'points' => $points, // Add points to the referral record
                ]);

                // Increment points for both referrer and referred user
                $referrer->increment('points', $points);
                $user->increment('points', $points);
            }
        }

        // Assign the 'user' role to the new user
        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }

        // Redirect with success message
        return redirect('/login')->with([
            'success' => [
                'title' => 'Registrasi Berhasil!',
                'message' => 'Akun berhasil didaftarkan, silahkan masuk',
            ],
        ]);
    }


    public function render()
    {
        return view('livewire.register-user');
    }
}
