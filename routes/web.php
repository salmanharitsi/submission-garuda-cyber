<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\ReferralController;
use Illuminate\Support\Facades\Route;

Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/referrals', [ReferralController::class, 'trackReferrals']);
    Route::get('/api/referral-code', [ReferralController::class, 'getReferralCode']);
    Route::get('/api/points', [PointController::class, 'getPoints']);
    Route::get('/api/point-history', [PointController::class, 'getPointHistory']);
});
