@extends('layouts.main')
@section('content')
<div class="container">
  <h2>Edit Employee Section</h2>
   {{ Form::model($users,['route' => ['employee.updateUser',$users->id],'method'=>'PUT','enctype' =>'multipart/form-data']) }}

   {{-- <div class="form-group">
    @foreach($users as $user)
    <label for="user_id" class="control-label">User identification: </label>
    {{ Form::text('user_id', $user->user_id,array('class'=>'form-control','id'=>'user_id')) }}

    @if($errors->has('user_id'))
     <small>{{ $errors->first('user_id') }}</small>
    @endif
    @endforeach
</div> --}}

<div class="md-form mb-5"> </div>
<div style="position: absolute; top: -9999px; left: -9999px;">
<label data-error="wrong" data-success="right" for="name"
    style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">User</label>
{!! Form::text('id', App\Models\User::where('id', Auth::id())->pluck('id')->first(),
        ['readonly'], null,['class' => 'form-control validate',]) !!}
   </div>






   {{-- <div class="form-group">
    @foreach($users as $user)
    <label for="name" class="control-label">Name: </label>
    {{ Form::text('name', $user->name,array('class'=>'form-control','id'=>'name')) }}

    @if($errors->has('name'))
     <small>{{ $errors->first('name') }}</small>
    @endif
    @endforeach
</div> --}}


{{-- <div class="form-group">
    @foreach($users as $user)
    <label for="email" class="control-label">Email: </label>
    {{ Form::text('email', $user->email,array('class'=>'form-control','id'=>'email')) }}

    @if($errors->has('email'))
     <small>{{ $errors->first('email') }}</small>
    @endif
    @endforeach
</div> --}}


<div class="form-group">
    @foreach($users as $user)
    <label for="role" class="control-label">Role: </label>
    {{ Form::text('role', $user->role,array('class'=>'form-control','id'=>'role')) }}

    @if($errors->has('role'))
     <small>{{ $errors->first('role') }}</small>
    @endif
    @endforeach
</div>

<button type="submit" class="btn btn-primary">Update</button>
<a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
{!! Form::close() !!} 
@endsection

@if (Auth::check() && Auth::user()->roles == 'Admin')
  <div class="form-group"> 
      <label for="job" class="control-label">Job:</label>
         {!! Form::select('job',[ 'pending' => 'pending', 'veterinarian
' => 'veterinarian','groomer'=>'groomer'], null,['class' => 'form-control','id'=>'job']) !!}
  </div>
  @else
     <div class="form-group"> 
    <label for="job" class="control-label">Job</label>
    {{ Form::text('job',null,array('class'=>'form-control','id'=>'job', 'readonly')) }}
  </div>
  @endif