<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Referral;
use Illuminate\Support\Facades\Auth;

class RecentReferral extends Component
{
    use WithPagination;

    public function render()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch referrals with the most recent first
        $referrals = Referral::with('referrer', 'referred')
            ->where(function ($query) use ($user) {
                $query->where('referrer_id', $user->id)
                    ->orWhere('referred_id', $user->id);
            })
            ->orderBy('created_at', 'desc') // Order by creation date, most recent first
            ->paginate(5);

        return view('livewire.recent-referral', [
            'referrals' => $referrals,
        ]);
    }
}
