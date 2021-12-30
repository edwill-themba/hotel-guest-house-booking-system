@if (count($errors) > 0)
   <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
             <li>{{ $error }}</li> 
          @endforeach
      </ul>
   </div> 
@endif

@if(session()->has('success_message'))
    <div class="alert alert-success">
       {{ session()->get('success_message')}}
    </div>  
@endif

@if(session()->has('error_message'))
    <div class="alert alert-danger">
       {{ session()->get('error_message')}}
    </div>  
@endif