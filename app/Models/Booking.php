<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Room;

class Booking extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'start_date',
        'end_date',
    ];

    /**
     * Esure that each booking is belongs to a user
     */
    public function user()
    {
       return $this->belongsTo('App\Model\User');
    }
    /**
     * Esure that each booking is belongs to a room
     */
    public function room()
    {
       return $this->belongsTo('App\Model\Room');
    }
}
