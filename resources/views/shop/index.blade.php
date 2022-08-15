@extends('layouts.main')
@section('title')
  laravel shopping cart
@endsection
@section('content')
@foreach($transacts->chunk(10) as $itemtransact)
        <div class="row">
             @foreach($itemtransact as $transact)
                <div class="col-sm-6 col-md-4">
<div class="thumbnail">
  <img src="{{ asset('images/'.$transact->img_path) }}" width ="180" height="180" >
<h3><center><strong><span>{{$transact->service_name}}</span></strong></center>
                        </h3>
            <center><a href="{{ route('service.addToCart', ['id'=>$transact->service_id]) }}" class="btn btn-primary" role="button">Add sa cart</a> </center>
</div>
<div class="caption"> 
                 
  </div> 
  </div>     
    @endforeach     
  @endforeach        
@endsection