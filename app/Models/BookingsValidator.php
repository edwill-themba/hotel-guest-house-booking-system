<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookingsValidator extends Model
{
    use HasFactory;
    
    /**
     * gets the room id  that needed to be allocated to a customer
     */
    public function getRoomId($start_date,$end_date)
    {
        
           $room_id = DB::table('rooms')
                    ->select('id')
                    ->whereNotIn('id',DB::table('bookings')
                                      ->select('room_id')
                                      ->whereNotBetween('start_date',[$start_date,$end_date]))
                                      ->limit(1)
                                      ->get();

           if($room_id){
              return $room_id;
           }else{
              return null;
           } 
    }

    /**
     * check if user has pending bookings on the given dates
     */
    public function user_bookings($user_id)
    {
        $found = false;
        
        $user_booking = DB::select("SELECT id FROM users WHERE id IN
                       (SELECT user_id FROM bookings WHERE user_id=:user_id)",['user_id' => $user_id]);

        if($user_booking){
            $found = true;
        }
        
     return $found;
    }
    
}
