<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use DB;

class CheckOutController extends Controller
{
    /**
     * display the check out screen
     */
    public function index()
    {
        //$products = Cart::content();
        return view('pages.checkout');
    }
    /**
     * store the cart information to the database
     * and charge customer via stripe
     */
    public function store(Request $request)
    {
        
        try{
         
        
         $stripe = new \Stripe\StripeClient("");
         $charge = $stripe->charges->create([
          'amount' => ($request->input('amount') * 100),
          'currency' => 'ZAR',
          'source' => $request->stripeToken, // obtained with Stripe.js
          'description' => 'Hotel Guest House stay'
        ]);
        $book = new CheckOut;
        $booking_id = $request->input('booking_id');
        $book->user_id = Auth::user()->id;
        $book->room_id = $request->input('room_id');
        $book->start_date = $request->input('start_date');
        $book->end_date = $request->input('end_date');
        $book->amount = $request->input('amount');
        $book->no_Of_Days = $request->input('no_Of_Days');
        $book->save();
        // update booking status
        $update_status = DB::update('update bookings set status = 1 where id =:id', ['id'=>$booking_id]);
        //cart holder name for the email
        $data = array(
          'email'      => $request->input('email'),
          'name'       => $request->input('name'),
          'amount'     => $request->input('amount'),
          'start_date' => $request->input('start_date'),
          'end_date'   => $request->input('end_date')
         );
        Mail::to($data['email'])->send(new SendMail($data));
        return redirect('/checkout')->with('success_message','thank you for choosing us');
        } catch(Exception $ex){
             return $ex->getMessage();
        }
    }
}

