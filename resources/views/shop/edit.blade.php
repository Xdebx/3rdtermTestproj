@extends('layouts.main')
@section('content')
<div class="container">
  <h2>Edit Employee Section</h2>
   {{ Form::model($transactions,['route' => ['transacts.update',$transactions->groominginfo_id],'method'=>'PUT','enctype' =>'multipart/form-data']) }}

   <div class="form-group"> 
    <label for="name" class="control-label">Status: </label>
    {{ Form::text('status',null,array('class'=>'form-control','groominginfo_id'=>'status')) }}
    @if($errors->has('status'))
    <small>{{ $errors->first('status') }}</small>
    @endif
  </div>

<br>
<button type="submit" class="btn btn-primary">Update</button>
<a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
{!! Form::close() !!} 
@endsection