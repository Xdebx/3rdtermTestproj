{{-- @extends('layouts.main')
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
                                    {{-- </center> --}}
                                    
                        {{-- </div> --}}
                    {{-- </div>
                </div>

                @endforeach
            </form>    
        </div>
@endsection --}} 





@extends('layouts.main')
@section('content')
<style>
body{
    background-color: #f9f9fa
}
p{
    background-color: #04f3ef
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden;
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(171, 234, 247, 0.08);
    box-shadow: 10px 10px 10px #00FFFF;
    border: none;
    margin-bottom: 30px;
}

.m-r-0 {
    margin-right: 0px;
}

.m-l-0 {
    margin-left: 0px;
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px;
}

.bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263);
}

.user-profile {
    padding: 20px 0;
}

.card-block {
    padding: 1.25rem;
}

.m-b-25 {
    margin-bottom: 25px;
}

.img-radius {
    border-radius: 5px;
}


 
h6 {
    font-size: 14px;
}

.card .card-block p {
    line-height: 25px;
}

@media only screen and (min-width: 1400px){
p {
    font-size: 14px;
}
}

.card-block {
    padding: 1.25rem;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
    margin-bottom: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.card .card-block p {
    line-height: 25px;
}

.m-b-10 {
    margin-bottom: 10px;
}

.text-muted {
    color: #fdfeff !important;
}

.b-b-default {
    border-bottom: 2px solid #e0e0e0;
}

.f-w-600 {
    font-weight: 600;
}

.m-b-20 {
    margin-bottom: 20px;
}

.m-t-40 {
    margin-top: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.m-b-10 {
    margin-bottom: 10px;
}

.m-t-40 {
    margin-top: 20px;
}

.user-card-full .social-link li {
    display: inline-block;
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

</style>

<div class="page-content page-container" id="page-content">
    @foreach($admins as $admin)
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                                                <div class="card user-card-full">
                                                    <div class="row m-l-0 m-r-0">
                                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                                            <div class="card-block text-center text-white">
                                                                <div class="m-b-25">
                                                                    {{-- <img src="{{ asset('images/'.$customer->img_path) }}" width ="100" height="100" class="img-circle" enctype="multipart/form-data"/> --}}
                                                                    <img src="{{ asset('images/'.$admin->img_path) }}" width ="100" height="100" class="img-circle" enctype="multipart/form-data"/>
                                                                </div>
                                                                <h6 class="f-w-600">{{ $admin->fname}} </h6>
                                                                {{-- <h6 class="f-w-600">{{ $customer->lname}}</h6> --}}
                                                               
                                                                <p>Web Designer</p>
                                                                <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="card-block">
                                                                <center><h6 class="m-b-20 p-b-5 b-b-default f-w-600">INFORMATION</h6></center>
                                                                
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Email</p>
                                                                        <h6 class="text-muted f-w-400">{{ $admin->email}}</h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Address</p>
                                                                        <h6 class="text-muted f-w-400">{{ $admin->addressline}}</h6>
                                                                    </div>
                                                                </div>
                                                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Recent</p>
                                                                        <h6> <a href="https://github.com/Xdebx/3rdtermTestproj" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="github" data-abc="true"><i class="mdi mdi-github feather icon-github github" aria-hidden="true"></i>Github</a></h6>
                                                                        <h6 class="text-muted f-w-400">Pet Clinic</h6>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">Most Viewed</p>
                                                                        <h6 class="text-muted f-w-400">Jacks</h6>
                                                                    </div>
                                                                </div>
                                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             </div>
                                                </div>
                                            </div>
                                            @endforeach
                                           
                                            @endsection

                                     