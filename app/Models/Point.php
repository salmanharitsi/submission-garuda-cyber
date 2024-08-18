<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'giver_id',
        'amount',
    ];

    /**
     * Get the user associated with the point.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that gave the points.
     */
    public function giver()
    {
        return $this->belongsTo(User::class, 'giver_id');
    }
}
