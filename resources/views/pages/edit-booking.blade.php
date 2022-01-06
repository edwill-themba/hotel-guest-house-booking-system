@extends('layouts.app')
@section('content')
   <div class="row">
       <div class="col-sm-12">
          <h1>Edit Bookings</h1>
           <form action="{{route('booking.update',$booking->id)}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="patch">
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
                  <button type="submit" class="btn btn-default">update</button>
                </div>
            </form>
       </div>
   </div>
@endsection