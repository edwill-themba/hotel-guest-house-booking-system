@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="cart card-header mt-3">
                <h3>Welcome <em class="user-name">{{ Auth::user()->name }}</em> To Hotel MET</h3>
            </div>
            <div class="cart cart-body">
               <p>View Your Bookings</p>
               <div class="form-row">
                 <a href="#" class="btn btn-info">View Current Bookings</a>
               </div>
               <form action="{{route('booking.store')}}" method="post">
                 {{ csrf_field() }}
                 <div class="form-row">
                     <label for="amount">Amount Charge Per Night</label>
                    <input type="text" class="form-control" name="amount" value="Exclusive 1500 per night" readonly>
                  </div>
                  <div class="form-row">
                     <label for="start_date">Check In Date:</label>
                     <input type="date" class="form-control" name="start_date" id="start_date">
                  </div>
                  <div class="form-row">
                     <label for="end_date">Check Out Date:</label>
                     <input type="date" class="form-control" name="end_date" id="end_date">
                  </div>
                  <div class="form-row">
                     <label for="end_date">Number Of Days To Stay:</label> 
                     <input type="text" class="form-control" name="no_Of_Days" id="no_of_Days" readonly>
                  </div>
                  <div class="form-row">
                     <button type="submit" class="btn btn-secondary">create booking</button>
                  </div>
               </form>
            </div>
        </div>
    </div>
@endsection