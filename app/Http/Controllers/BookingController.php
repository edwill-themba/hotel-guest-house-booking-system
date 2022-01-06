<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\BookingsValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // create a constructor for booking controller
    public function __construct()
    {
        $booking_validator = new BookingsValidator;
        //deletes all passed bookings
        $booking_validator->delete_user_bookings();
        //deletes upaid bookings
        $booking_validator->delete_unpaid_bookings();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = DB::table('users')
                      ->join('bookings','users.id','=','bookings.user_id')
                      ->select('users.name','bookings.*')
                      ->get();
        return view('pages.all-bookings')->with('bookings',$bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create-booking');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'start_date' => 'required|date|after:today',
           'end_date'   => 'required|date|after:start_date',
           'no_Of_Days' => 'required'
         ]);

         //get inputs from the user
         $room_type = $request->input('room_type');
         $no_Of_Days = $request->input('no_Of_Days');
         $start_date = $request->input('start_date');
         $end_date = $request->input('end_date');
         $amount = 1500;
         $user_id = Auth::user()->id;
         // Initialize bookings validator
         $booking_validator = new BookingsValidator;
         // calculate the amount charge by room per night amout times with number of days
         $charge_amount = $amount * $no_Of_Days;
         // get room id
         $room_id = $booking_validator->getRoomId($start_date,$end_date);
        
         // check if rooms are fully booked
         if($room_id == 0){
             return redirect('/booking/create')->with('error_message','Sorry we are currently booked on this dates,please choose other dates');
         }
         $booking_room_id = $room_id;

        // check if user has booked more than 5 days
         if($no_Of_Days > 5){
             return redirect('/booking/create')->with('error_message','you are not allowed to stay more than 5 days');
         }
         //check if user has pending bookings
          $user_bookings = $booking_validator->user_bookings($user_id);
         if($user_bookings == true){
            return redirect('/booking/create')->with('error_message','sorry you have a pending booking'); 
         }
        
         $booking = new Booking;
         $booking->start_date = $start_date;
         $booking->end_date = $end_date;
         $booking->no_Of_Days = $no_Of_Days;
         $booking->user_id = $user_id;
         $booking->room_id =$booking_room_id;
         $booking->amount = $charge_amount;
         $booking->status = 0;
         $booking->save();
         return redirect()->route('booking.show',['id'=>$booking->id])->with('success_message','Booking was successful'); 
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrfail($id);
        return view('pages.proceed-payment')->with('booking',$booking);
    }
    
    /**
     * Show the form for editing resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::findOrfail($id);
        return view('pages.edit-booking')->with('booking',$booking);
    }

    /**
     * Update the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      
        $this->validate($request,[
            'start_date' => 'required|date|after:today',
            'end_date'   => 'required|date|after:start_date',
            'no_Of_Days' => 'required'
          ]);
 
          //get inputs from the user
          $room_type = $request->input('room_type');
          $no_Of_Days = $request->input('no_Of_Days');
          $start_date = $request->input('start_date');
          $end_date = $request->input('end_date');
          $amount = 1500;
          // Initialize bookings validator
          $booking_validator = new BookingsValidator;
          // calculate the amount charge by room per night amout times with number of days
          $charge_amount = $amount * $no_Of_Days;
          // get room id
          $room_id = $booking_validator->getRoomId($start_date,$end_date);
         
          // check if rooms are fully booked
          if($room_id == 0){
              return redirect('/booking/create')->with('error_message','Sorry we are currently booked on this dates,please choose other dates');
          }
          $booking_room_id = $room_id;
 
         // check if user has booked more than 5 days
          if($no_Of_Days > 5){
              return redirect('/booking/create')->with('error_message','you are not allowed to stay more than 5 days');
          }
          // search booking
          $booking = Booking::find($id);
          $booking->start_date = $start_date;
          $booking->end_date = $end_date;
          $booking->no_Of_Days = $no_Of_Days;
          $booking->room_id =$booking_room_id;
          $booking->amount = $charge_amount;
          //check if login user is authorized to delete the bookings or not
          if(Auth::user()->id !== $booking->user_id){
           return redirect()->route('booking.index')->with('error_message','you are not authorized to update this booking');
          }
          $booking->save();
          return redirect()->route('booking.index')->with('success_message','Booking was successful updated'); 
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        //check if login user is authorized to delete the bookings or not
        if(Auth::user()->id !== $booking->user_id){
            return redirect()->route('booking.index')->with('error_message','you are not authorized to update this booking');
        }
        $booking->delete();
        return redirect('/booking/create')->with('success','booking was successfully cancel');
    }
}
