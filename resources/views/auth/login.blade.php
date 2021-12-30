@extends('layouts.app')
@section('content')
   <div class="user-login">
         <div class="row mt-4">
            <div class="col-6 offset-3">
                <h3>Login</h3>
                  <form action="{{route('login.user')}}" method="post">
                      {{ csrf_field() }}
                      <div class="form-row">
                          <input type="text" name="email" placeholder="Enter your email" class="form-control">
                      </div>
                       <div class="form-row">
                          <input type="password" name="password" placeholder="Enter your password" class="form-control">
                      </div>
                       <div class="form-row">
                          <input type="submit" name="submit" value="login" class="btn btn-primary btn-block">
                      </div>
                  </form>
                </div>
         </div>
     </div>
@endsection