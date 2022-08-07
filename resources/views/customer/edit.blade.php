 @extends('layouts.main')
@section('content')
<div class="container">
  <h2>Edit Customer section</h2>
   {{ Form::model($customer,['route' => ['customer.update',$customer->customer_id],'method'=>'PUT','enctype' =>'multipart/form-data']) }}


   <div class="form-group"> 
    <label for="name" class="control-label">Title: </label>
    {{ Form::text('title',null,array('class'=>'form-control','customer_id'=>'title')) }}
    @if($errors->has('title'))
    <small>{{ $errors->first('title') }}</small>
    @endif
  </div>

   <div class="form-group"> 
    <label for="fname" class="control-label">First Name: </label>
    {{ Form::text('fname',null,array('class'=>'form-control','customer_id'=>'fname')) }}
    @if($errors->has('fname'))
    <small>{{ $errors->first('fname') }}</small>
    @endif
  </div>

  <div class="form-group"> 
    <label for="lname" class="control-label">Last name: </label>
    {{ Form::text('lname',null,array('class'=>'form-control','customer_id'=>'lname')) }}
    @if($errors->has('lname'))
    <small>{{ $errors->first('lname') }}</small>
    @endif
  </div> 

  <div class="form-group"> 
    <label for="addressline" class="control-label">Addressline: </label>
    {{ Form::text('addressline',null,array('class'=>'form-control','customer_id'=>'addressline')) }}
    @if($errors->has('addressline'))
    <small>{{ $errors->first('addressline') }}</small>
    @endif
  </div>
  <div class="form-group"> 
    <label for="zipcode" class="control-label">Zipcode:</label>
    {{ Form::text('zipcode',null,array('class'=>'form-control','customer_id'=>'zipcode')) }}
    @if($errors->has('zipcode'))
    <small>{{ $errors->first('zipcode') }}</small>
    @endif
  </div>
  <div class="form-group"> 
    <label for="phone" class="control-label">Phone:</label>
    {{ Form::text('phone',null,array('class'=>'form-control','customer_id'=>'phone')) }}
    @if($errors->has('phone'))
    <small>{{ $errors->first('phone') }}</small>
    @endif
  </div>

<div class="form-group">
    @foreach($users as $user)
    <label for="email" class="control-label">Email: </label>
    {{ Form::text('email', $user->email,array('class'=>'form-control','id'=>'email')) }}

    @if($errors->has('email'))
     <small>{{ $errors->first('email') }}</small>
    @endif
    @endforeach
</div>

<div class="form-group"> 
  @foreach($users as $user)
  <label for="password" class="control-label">Password</label>
  <input type="password" class="form-control " id="password" name="password" value="('password', $user->password)">
  </text>@if($errors->has('password'))
  <div class="alert alert-danger">{{ $errors->first('password') }}</div>
 @endif 
 @endforeach
</div>

{{-- <div class="form-group"> 
  <label for="password" class="control-label">Password:</label>
  {{ Form::text('password',$user->password,array('class'=>'form-control','id'=>'password')) }}
  @if($errors->has('password'))
  <small>{{ $errors->first('password') }}</small>
  @endif
</div> --}}


{{-- 
<div class="form-group">
  @foreach($users as $user)
  <label for="email" class="control-label">Email</label>
  {{ Form::text('email', $user->email,array('class'=>'form-control','id'=>'email')) }}

  @if($errors->has('email'))
   <small>{{ $errors->first('email') }}</small>
  @endif
  @endforeach
</div> --}}

 <div class="form-group">
  <label for="image" class="control-label">Customer Image:</label>
  <input type="file" class="form-control" id="image" name="image">
   <img src="{{ asset('images/'.$customer->img_path) }}" width ="60" height="60" class="img-circle" enctype="multipart/form-data"/>
  @if($errors->has('img_path'))
   <div class="alert alert-danger">{{ $errors->first('img_path') }}</div>
  @endif
</div>

<button type="submit" class="btn btn-primary">Update</button>
<a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
{!! Form::close() !!} 
@endsection 