{{-- @extends('layouts.master')
@section('content')
@if ($message = Session::get('success'))
 <div class="alert alert-success alert-block">
 <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
 </div>
@endif
<table class="table table-striped">
  <tr>{{ link_to_route('customer.create', 'Add new customer:')}}</tr>
  <thead>
  <tr>
    <th>Customer ID</th>
    <th>Customer Fname</th>
    <th>Customer Lname</th>
    <th>Customer Address</th>
    <th>Customer Town</th>
    <th>Customer Zipcode</th>
    <th>Customer Phone</th>
    <th>Customer Zipcode</th>
    <th colspan="1">Action</th>
    <th colspan="1">Action</th>
  </tr>
</thead>
<tbody>
      @foreach($customers as $customer)
      <tr>
        <td>{{$customer->customer_id}}</td>
        <td>{{$customer->title}}</td>
        <td>{{$customer->lname}}</td>
        <td>{{$customer->fname}}</td>
        <td>{{$customer->addressline}}</td>
        <td>{{$customer->phone}}</td>
        <td>{{$customer->zipcode}}</td>
        <td><img src="{{ asset('images/'.$customer->img_path) }}" width ="80" height="80" class="img-circle" enctype="multipart/form-data"/></td>

        <td align="center">
          @if($customer->deleted_at)
            <i class="fas fa-eye" aria-hidden="true" style="font-size:24px; color:gray" ></i></a>
          @else
          <a href="{{ route('customer.show',$customer->customer_id) }}">
            <i class="fas fa-eye" aria-hidden="true" style="font-size:24px" ></i></a>
          @endif
           </td>
        <td align="center">
          @if($customer->deleted_at)
            <ii class="fas fa-user-edit" aria-hidden="true" style="font-size:24px; color:gray" ></i></a>
          @else
          <a href="{{route('customer.edit',$customer->customer_id)}}">
            <i class="fas fa-user-edit" aria-hidden="true" style="font-size:24px" ></i></a>
          @endif
           </td>
      <td align="center">
          @if($customer->deleted_at)
              <i class="fas fa-user-times" style="font-size:24px; color:gray" ></i>
          @else
              {!! Form::open(array('route' => array('customer.destroy', $customer->customer_id),'method'=>'DELETE')) !!}
             <button ><i class="fas fa-user-times" style="font-size:20px; color:red" ></i></button>
             {!! Form::close() !!}
           @endif
         </td>
      </tr>
      @endforeach
</table>
<div>{{$customers->links()}}</div>
</div>
</div>
@endsection --}}








@extends('layouts.main')

{{-- @extends('layouts.base')
@extends('layouts.app') --}}
@section('content')
<div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
     {{-- <form method="GET" action="{{url('artist')}}" >
      <div class="form-group col-md-4">
       <label for="genre">Search</label>
       <input type="text" class="form-control" name="search" id="genre" Placeholder="Search Listener name or Album name">
    </div>
    </form> --}}
      @include('partials.search')
    <table class="table table-striped">
      <tr>{{ link_to_route('listener.create', 'Add new listener:')}}</tr>
      <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Fname</th>
        <th>Lname</th>
        <th>Address</th>
        <th>Town</th>
        <th>Zipcode</th>
        <th>Phone</th>
        <th>Zipcode</th>
        <th>Pets</th>
        <th colspan="1">Action</th>
        <th colspan="1">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($customers as $customer)
      <th>{{$customer->customer_id}}</th>
      <th>{{$customer->title}}</th>
      <th>{{$customer->lname}}</th>
      <th>{{$customer->fname}}</th>
      <th>{{$customer->addressline}}</th>
      <th>{{$customer->phone}}</th>
      <th>{{$customer->zipcode}}</th>
      <th><img src="{{asset($customer->img_path) }}"width="80" height="80" /></th>
      <th> @foreach($pet->pets as $pet)
             <li>{{$pet->pname}} </li>   
        @endforeach
        </th>
        <td><a href="{{action('CustomerController@edit', $customer->customer_id)}}" class="btn btn-warning">Edit</a></td>
       <td>
          <form action=" {{action('CustomerController@destroy', $customer->customer_id)}}" method="post">
           {{ csrf_field() }}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
          </td>
      </tr>
      @endforeach
  </tbody>
  </table>
  </div>
  @endsection






