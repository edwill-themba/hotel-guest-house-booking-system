<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Room extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'price',
    ];
    
    /**
     * Ensure that room has one booking at a time
     */
    public function booking()
    {
        return $this->hasOne('App\Models\Booking');
    }
}
