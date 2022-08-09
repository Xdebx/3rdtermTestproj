@extends('layouts.main')
@section('content')
<style>
 .container {
  color:  #FFFFFF;
}
</style>
<div class="container">
  <h2>Edit Consultation</h2>
    {{ Form::model($consult,['route' => ['consult.update',$consult->consult_id],'method'=>'PUT','enctype' =>'multipart/form-data']) }}

<div class="md-form mb-5"></div>
    <i class="fas fa-user"></i>
        <label data-error="wrong" data-success="right" for="name"
                    style="display: inline-block; width: 150px;">Veterinarian</label>
      {!! Form::select('emp_id', App\Models\Employee::pluck('lname','emp_id'), null,['class' => 'form-control']) !!}
<div class="md-form mb-5"></div>
    <i class="fas fa-cat"></i>
    <label data-error="wrong" data-success="right" for="name"
                    style="display: inline-block; width: 150px;">Pet</label>
      {!! Form::select('pet_id', App\Models\Pet::pluck('pname','pet_id'), null,['class' => 'form-control']) !!}
  <div class="md-form mb-5"></div>
  <i class="fas fa-signature"></i>
    <label for="observation">Observation</label>
    {!! Form::text('observation',$consult->observation,array('class' => 'form-control')) !!}
    @if($errors->has('observation'))
    <div class="alert alert-danger">{{ $errors->first('observation') }}</div>
   @endif 
  
  <div class="md-form mb-5"></div>
  <i class="fas fa-dollar-sign"></i>
    <label for="consult_cost">Consult Cost</label>
    {!! Form::text('consult_cost',$consult->consult_cost,array('class' => 'form-control')) !!}
    @if($errors->has('consult_cost'))
    <div class="alert alert-danger">{{ $errors->first('consult_cost') }}</div>
   @endif 
  
   <div class="md-form mb-5"></div>
            <i class="fas fa-disease"></i>
            <label data-error="wrong" data-success="right" for="name"
            style="display: inline-block; width: 150px;">Disease</label>
    @foreach ($diseases as $disease_id => $disease) 
             <div class="form-check form-check-inline">
     @if (in_array($disease_id, $consults))
     {!! Form::checkbox('disease_id[]',$disease_id, true, array('class'=>'form-check-input','disease_id'=>'disease')) !!} 
      {!!Form::label('disease', $disease,array('class'=>'form-check-label')) !!}
      @else
    {!! Form::checkbox('disease_id[]',$disease_id, null, array('class'=>'form-check-input','disease_id'=>'disease')) !!} 
      {!!Form::label('disease', $disease,array('class'=>'form-check-label')) !!}
     @endif
  @endforeach 
  </div>

<button type="submit" class="btn btn-primary">Update</button>
<a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>     
</div>
{!! Form::close() !!} 
@endsection