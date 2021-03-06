@extends('layouts.app')
@section('content')
<div class="row">
     <div class="col-sm-12">
          <table class="table table striped">
              <tr>
                 <th>Cancel Booking</th>
                 <th>Edit Booking</th>
              </tr>
              <tr>
                <td>
                 <!-- form for cancel order -->
                 <form action="/booking/{{$booking->id}}/delete" method="POST">
                   {{ csrf_field() }}
                   <input type="hidden" name="_method" value="delete">
                   <button type="submit" class="btn btn-danger btn-block">Cancel Booking</button>
                 </form>
                 <!-- end form -->
                </td>
                <td>
                <a href="/booking/{{$booking->id}}/edit" class="btn btn-warning">Edit Booking</a>
                </td>
              </tr>
           </table>
           <h3>Proceed Payments</h3>
            <!-- stripe payment form -->
          <form id="payment-form" method="POST" class="frm-payment" action="{{route('checkout.store')}}">
              {{ csrf_field() }}
                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                <input type="hidden" name="amount" value="{{$booking->amount}}">
                <input type="hidden" name="no_Of_Days" value="{{$booking->no_Of_Days}}">
                <input type="hidden" name="start_date" value="{{$booking->start_date}}">
                <input type="hidden" name="end_date" value="{{$booking->end_date}}">
                <input type="hidden" name="room_id" value="{{$booking->room_id}}">
               <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Enter the name on the card" required>
              </div>
              <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Enter you email address" required>
              </div>
              <div class="form-group">
                <div id="card-element">
                <!-- Elements will create input elements here -->
                </div>
              </div>
              <!-- We'll put the error messages in this element -->
              <div id="card-errors" role="alert"></div>
               <input type="submit" class="btn-pay" id="btnPayment" value="Submit" class="btn btn-default">
            </form>
            <!-- end stripe form -->
          </div>
     </div>
@endsection
<script src="https://js.stripe.com/v3/"></script>
<style>
  /* Variables */


form {
 width: 30vw;
 min-width: 500px;
 align-self: center;
 box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
   0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
 border-radius: 7px;
 padding: 40px;
}

input {
 border-radius: 6px;
 margin-bottom: 6px;
 padding: 12px;
 border: 1px solid rgba(50, 50, 93, 0.1);
 height: 44px;
 font-size: 16px;
 width: 100%;
 background: white;
}

.result-message {
 line-height: 22px;
 font-size: 16px;
}

.result-message a {
 color: rgb(89, 111, 214);
 font-weight: 600;
 text-decoration: none;
}

.hidden {
 display: none;
}

#card-error {
 color: rgb(105, 115, 134);
 text-align: left;
 font-size: 13px;
 line-height: 17px;
 margin-top: 12px;
}

#card-element {
 border-radius: 4px 4px 0 0 ;
 padding: 12px;
 border: 1px solid rgba(50, 50, 93, 0.1);
 height: 44px;
 width: 100%;
 background: white;
}

#payment-request-button {
 margin-bottom: 32px;
}

/* Buttons and links */
button {
 background: #5469d4;
 color: #ffffff;
 font-family: Arial, sans-serif;
 border-radius: 0 0 4px 4px;
 border: 0;
 padding: 12px 16px;
 font-size: 16px;
 font-weight: 600;
 cursor: pointer;
 display: block;
 transition: all 0.2s ease;
 box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
 width: 100%;
}
button:hover {
 filter: contrast(115%);
}
button:disabled {
 opacity: 0.5;
 cursor: default;
}

/* spinner/processing state, errors */
.spinner,
.spinner:before,
.spinner:after {
 border-radius: 50%;
}
.spinner {
 color: #ffffff;
 font-size: 22px;
 text-indent: -99999px;
 margin: 0px auto;
 position: relative;
 width: 20px;
 height: 20px;
 box-shadow: inset 0 0 0 2px;
 -webkit-transform: translateZ(0);
 -ms-transform: translateZ(0);
 transform: translateZ(0);
}
.spinner:before,
.spinner:after {
 position: absolute;
 content: "";
}
.spinner:before {
 width: 10.4px;
 height: 20.4px;
 background: #5469d4;
 border-radius: 20.4px 0 0 20.4px;
 top: -0.2px;
 left: -0.2px;
 -webkit-transform-origin: 10.4px 10.2px;
 transform-origin: 10.4px 10.2px;
 -webkit-animation: loading 2s infinite ease 1.5s;
 animation: loading 2s infinite ease 1.5s;
}
.spinner:after {
 width: 10.4px;
 height: 10.2px;
 background: #5469d4;
 border-radius: 0 10.2px 10.2px 0;
 top: -0.1px;
 left: 10.2px;
 -webkit-transform-origin: 0px 10.2px;
 transform-origin: 0px 10.2px;
 -webkit-animation: loading 2s infinite ease;
 animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
 0% {
   -webkit-transform: rotate(0deg);
   transform: rotate(0deg);
 }
 100% {
   -webkit-transform: rotate(360deg);
   transform: rotate(360deg);
 }
}
@keyframes loading {
 0% {
   -webkit-transform: rotate(0deg);
   transform: rotate(0deg);
 }
 100% {
   -webkit-transform: rotate(360deg);
   transform: rotate(360deg);
 }
}

@media only screen and (max-width: 600px) {
 form {
   width: 80vw;
 }
}

</style>
