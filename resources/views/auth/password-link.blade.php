<p>Forgot password,Change Here</p>
   <form action="http://127.0.0.1:8000/update_user/{{$data['id']}}"  method="POST">
       {{ csrf_field() }}
       <input type="hidden" name="_method" value="patch">
       <input type="hidden" name="user_id" value="{{ $data['id'] }}">
       <input type="text" name="name" value="{{ $data['name'] }}">
       <input type="password" name="password" placeholder="please enter your new password">
       <button type="submit" class="btn btn-primary">Enter your new password</button>
  </form>
  <p>Check </p>
