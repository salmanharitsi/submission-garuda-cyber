<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate the registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'referral_code' => 'nullable|exists:users,referral_code',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => Str::random(10),
        ]);

        // If a referral code is provided, create a referral record
        if ($request->referral_code) {
            $referrer = User::where('referral_code', $request->referral_code)->first();

            // Create a new referral
            Referral::create([
                'referrer_id' => $referrer->id,
                'referred_id' => $user->id,
            ]);

            // Increment points for both the referrer and the referred user
            $referrer->increment('points', 50);
            $user->increment('points', 50);
        }

        // Return a success response
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        /**
         * Validate the login request data.
         */
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /**
         * Attempt to authenticate the user with the provided credentials.
         */
        if (Auth::attempt($request->only('email', 'password'))) {
            // Get the authenticated user
            $user = Auth::user();

            // Create a new personal access token for the user
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return a success response with the generated token
            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        /**
         * Return an error response if the credentials are invalid.
         */
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
