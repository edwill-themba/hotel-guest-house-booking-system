<nav class="navbar navbar-light bg-light">
  <div class="container">
   <a class="navbar-brand brand" href="/">Hotel-Booking-System</a>
    <ul class="main-menu">
       <li><a href="/">Home</a></li>
      @auth
       <li><a href="{{route('logout.user')}}"  onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
             {{ __('logout') }}
           </a>
           <form action="{{route('logout.user')}}" id="logout-form" method="post" style="display:none;">
              {{ csrf_field() }}
           </form>
      </li>
       <li><a href="#">{{ Auth::user()->name }}</a></li>
       <li><a href="/booking/create">Make Booking</a></li>
      @else
       <li><a href="/register_view">Register</a></li> 
       <li><a href="/login_view">Login</a></li>
      @endauth
       <li><a href="#">About Us</a></li>
    </ul>
  </div>
</nav>