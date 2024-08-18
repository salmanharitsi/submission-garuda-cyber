<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Get the current points of the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPoints(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Return the user's points
        return response()->json(['points' => $user->points]);
    }

    /**
     * Get the point transaction history of the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPointHistory(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Retrieve and order the user's point transactions by the most recent
        $pointHistory = $user->pointTransactions()->orderBy('created_at', 'desc')->get();

        // Return the point transaction history
        return response()->json(['point_history' => $pointHistory]);
    }
}
