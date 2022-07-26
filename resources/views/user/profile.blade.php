@extends('layouts.master')
{{-- @extends('layouts.base')   
@extends('layouts.app') --}}
@section('content')
<style>
h2{
  color: #00FFFF;
}
strong {
    color: #000000;
}
.container .user-profile{
  border: 2px solid;
  padding: 2px;
  box-shadow: 5px 5px 5px #00FFFF;
    margin-top: 15%;
    margin-bottom: 10%;
    border-radius: 50rem;
}
</style>
<div class="container user-profile">
            <form method="post">
                @foreach($customers as $customer)
                <div class="row">
                    <div class="col-md-12">
                            <center>
                                <a href="{{route('customer.edit',$customer->customer_id)}}">
                                    <i class="fas fa-edit" aria-hidden="true" style="font-size:50px" > Edit </i></a>

                                 <h2>Profile Picture</h2>
                                    <p><strong><td><img src="{{ asset('images/'.$customer->img_path) }}" width ="100" height="100" class="img-circle" enctype="multipart/form-data"/></td></strong></p>
                                            
                                    <h2>
                                        <p>Firstname:<strong>{{ $customer->fname}}</strong></p>
                                    </h2>
                                     <h2>
                                        <p>Lastname:<strong>{{ $customer->lname}}</strong></p>
                                    </h2>
                                    <h2>
                                         <p>Email: <strong>{{ $customer->email}}</strong></p>
                                    </h2>
                                    <h2>
                                        <p>Address: <strong>{{ $customer->addressline}}</strong></p>
                                    </h2>
                                    <h2>
                                       <p>Zipcode: <strong>{{ $customer->zipcode}}</strong></p>
                                    </h2>
                                     <h2>
                                      <p>Phone: <strong>{{ $customer->phone}}</strong></p>
                                    </h2>
                                    {{-- <a href="{{route('customer.edit',$customer->customer_id)}}">
                                        <i class="fas fa-user-edit" aria-hidden="true" style="font-size:50px" ></i></a> --}}
                                    </center>
                                    
                        {{-- </div> --}}
                    </div>
                </div>

                @endforeach
            </form>    
        </div>
@endsection