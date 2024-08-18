<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    /**
     * Track the referrals made by the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function trackReferrals(Request $request)
    {
        // Get the authenticated user
        $user = $request->user(); 

        // Retrieve referrals for the user and include referred user details
        $referrals = Referral::where('referrer_id', $user->id)
                             ->with('referred:id,name,email')
                             ->get();

        // Return the referrals and the total count
        return response()->json([
            'referrals' => $referrals,
            'total_referrals' => $referrals->count(),
        ]);
    }

    /**
     * Get the referral code for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReferralCode(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Return the user's referral code
        return response()->json(['referral_code' => $user->referral_code]);
    }
}
