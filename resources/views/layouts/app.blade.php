<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Met Hotel</title>
         <!-- include custom style -->
         <link href="{{asset('css/style.css')}}" rel="stylesheet" >
         <!-- include app style sheet -->
         <link href="{{asset('css/app.css')}}" rel="stylesheet" >
          <!-- include bootstrap style sheet -->
         <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" >
          <!-- include font-awsome style sheet -->
         <link href="{{asset('css/all.css')}}" rel="stylesheet">
    </head>
    <body>
        @include('nav.navbar')
        <div class="container">
           <!-- include error and success messgaes -->
           <div class="messsages">
             @include('message.messages')
           </div>
             @yield('content')
        </div>
        <!-- jquery js -->
        <script src="{{asset('js/jquery-3.3.1.js')}}"></script>
         <!-- bootstrap js -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
         <!-- font-awesome js -->
        <script src="{{asset('js/all.js')}}"></script>
        <!-- app bookings  js -->
        <script src="{{asset('js/app-bookings.js')}}"></script>
        <!-- include stripe payment charge -->
        <script src="{{asset('js/charge.js')}}"></script>
    </body>
</html>
