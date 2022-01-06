<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Room;
use function GuzzleHttp\json_decode;

class BookingsValidator extends Model
{
    use HasFactory;
    
    /**
     * gets the room id  that needed to be allocated to a customer I have 2 rooms on the database
     * it will depend on the number of rooms you have in your database just replace the with your
     * own number
     */
    public function getRoomId($start_date,$end_date)
    {
          // check that if rooms are empty or not between start date and end date
          $room = DB::table('bookings')
                     ->select('room_id')
                     ->whereBetween('start_date',[$start_date,$end_date])
                     ->whereBetween('start_date',[$start_date,$end_date])
                     ->get();
          // this is just for testing purpose I have two rooms on the database  and it means rooms are fully booked on that date
        if(count($room)  == 2){
            return 0;
        }elseif(count($room)==0){
           // this is where all rooms are free
            $roomid_array = Room::where('type','Exclusive')
                                 ->select('id')
                                 ->get();
            return $roomid_array[0]['id'];
        }
        else{
            // get all the rooms from rooms table
            $roomid_array = Room::where('type','Exclusive')
                                ->select('id')
                                ->get();
            // get room id booked with specified dates
            $roomid = Booking::select('room_id')
                             ->whereBetween('start_date',[$start_date,$end_date])
                             ->whereBetween('end_date',[$start_date,$end_date])
                             ->get();
            // loop of all room id the 2 is for testing because I have 2 rooms on the database
            foreach($roomid as $room_id){
                foreach($roomid_array as $room_nr){
                    if($room_id->room_id !== $room_nr->id){
                        return $room_nr->id;
                    }
                }
            }
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

    /**
     * deletes bookings that end dates has passed
     */
    public function delete_user_bookings()
    {
        $today = date('Y-m-d');
        
        $old_bookings = DB::delete('delete from bookings where end_date <=:end_date', ['end_date' => $today]);
    }
    
    /**
     * deletes booking that were made and not been paid for one day
     */
    public function delete_unpaid_bookings()
    {
        $created = now();
        $status = 0;
        $delete_upaid_bookings = DB::table('bookings')
                                   ->where('created_at', '<=', $created)
                                   ->where('status','=',$status)
                                   ->delete();
    }
    
}
