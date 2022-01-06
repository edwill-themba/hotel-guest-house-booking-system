@extends('layouts.app')
@section('content')
 <div class="row mt-4">
  <div class="col-6 offset-3">
      <form  action="{{route('user.link')}}"    method="POST">
           {{ csrf_field() }}
           <div class="form-row">
             <label for="email">Enter Your Email Address</label>
             <input type="email" name="email" class="form-control" placeholder="Enter your email">
           </div>
           <div class="form-row">
             <input type="submit" value="send link" class="btn btn-primary btn-block">
           </div>
      </form>
    </div>
 </div>
@endsection