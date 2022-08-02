@extends('layouts.main')
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
<div class="container emp-profile">
            <form method="post">
                @foreach($employees as $employee)
                <div class="row">
                    <div class="col-md-12">
                            <center>
                                <a href="{{route('employee.edit',$employee->emp_id)}}">
                                    <i class="fas fa-edit" aria-hidden="true" style="font-size:50px" > Edit </i></a>

                                 <h2>Profile Picture</h2>
                                    <p><strong><td><img src="{{ asset('images/'.$employee->img_path) }}" width ="100" height="100" class="img-circle" enctype="multipart/form-data"/></td></strong></p>
                                            
                                    <h2>
                                        <p>Firstname:<strong>{{ $employee->fname}}</strong></p>
                                    </h2>
                                     <h2>
                                        <p>Lastname:<strong>{{ $employee->lname}}</strong></p>
                                    </h2>
                                    <h2>
                                         <p>Email: <strong>{{ $employee->email}}</strong></p>
                                    </h2>
                                    <h2>
                                        <p>Address: <strong>{{ $employee->addressline}}</strong></p>
                                    </h2>
                                    <h2>
                                       <p>Zipcode: <strong>{{ $employee->zipcode}}</strong></p>
                                    </h2>
                                     <h2>
                                      <p>Phone: <strong>{{ $employee->phone}}</strong></p>
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