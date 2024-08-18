<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;

class GiveHistory extends Component
{
    use WithPagination;

    public function render()
    {
        $user = Auth::user();

        // Determine if the user is an admin or a regular user
        if ($user->hasRole('admin')) {
            // Admins can see all point history, ordered by newest first
            $points = Point::with('user')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            // Regular users can only see their own point history, ordered by newest first
            $points = Point::where('user_id', $user->id)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('livewire.give-history', [
            'points' => $points,
        ]);
    }
}
