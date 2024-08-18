<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;

class GivePoints extends Component
{
    use WithPagination;

    public $selectedUserId;
    public $pointsAmount = 0;
    public $showModal = false;

    protected $rules = [
        'pointsAmount' => 'required|integer|min:1',
    ];

    public function render()
    {
        $users = User::where('id', '!=', Auth::id())
            ->orderBy('created_at', 'desc') // Assuming 'created_at' is the field to order by
            ->paginate(5);

        return view('livewire.give-points', [
            'users' => $users,
        ]);
    }

    public function openModal($userId)
    {
        $this->selectedUserId = $userId;
        $this->pointsAmount = 0; // Reset points amount
        $this->showModal = true;
    }

    public function givePoints()
    {
        $this->validate();

        $user = User::find($this->selectedUserId);

        if ($user) {
            // Create a new point record
            Point::create([
                'user_id' => $user->id,
                'amount' => $this->pointsAmount,
                'giver_id' => auth()->id(),
            ]);

            // Optionally, update the user's total points
            $user->increment('points', $this->pointsAmount);

            // Close modal and reset selected user ID
            $this->showModal = false;
            $this->selectedUserId = null;

            return redirect()->intended('admin/dashboard')->with([
                'success' => [
                    "title" => "Point berhasil ditambahkan",
                ]
            ]);
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedUserId = null;
    }
}
