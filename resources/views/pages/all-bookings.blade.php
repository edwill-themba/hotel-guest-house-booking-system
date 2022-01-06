@extends('layouts.app')
@section('content')
     <div class="col-sm-12">
         <h1>All Bookings</h1>
         @if(count($bookings) > 0)
             <table class="table table-striped">
                 <tr>
                     <th>Full Names</th>
                     <th>Check In Date</th>
                     <th>Check Out Date</th>
                     <th>No Of Days</th>
                 </tr>
                 @foreach ($bookings as $book)
                   <tr>
                     <td>{{ $book->name }}</td>
                     <td>{{ $book->start_date }}</td>
                     <td>{{ $book->end_date }}</td>
                     <td>{{ $book->no_Of_Days }}</td>
                    </tr> 
                 @endforeach
             </table>
         @else
            <p>No Bookings Found</p>
         @endif
     </div>
@endsection