@extends('layouts.main')
@section('title')
    Laravel Shopping Cart
@endsection
@section('content')
<style>
    .row{
        color: white;
    }
    .list-group-item{
        color: black;
    }
</style>
    @if(Session::has('cart'))
        <div class="row">

            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    <form method="post" action="{{route('service.checkout')}}" enctype="multipart/form-data" >
  @csrf
  <div class="form-group">
    <label for="pet_id">Pet name</label>
    {!! Form::select('pet_id', $pets, null, ['placeholder'=>'******Please Choose!******' ,'class' => 'form-control']) !!}
    @if($errors->has('pet_id'))
    <div class="alert alert-danger">{{ $errors->first('pet_id') }}</div>
   @endif 
  </div>
                    @foreach($services as $service)
                            <li class="list-group-item">
                                <span class="badge">{{ $service['qty'] }}</span>
                                <strong>{{ $service['service']['service_name'] }}</strong>
                                <span class="label label-success">{{ $service['price'] }}</span>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                    <li><a href="{{ route('service.remove',['id'=>$service['service']['service_id']]) }}">Reduce All</a></li>
                                    </ul>
                                </div>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3"style="font-size:300%">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
            <center><button type="submit" class="btn btn-primary">Checkout</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a></center>
  </div>     
</div>
</form> 
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No Items in Cart!</h2>
            </div>
        </div>
    @endif
@endsection