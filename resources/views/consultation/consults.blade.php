@extends('layouts.main')
{{-- @extends('layouts.app') --}}
@section('body')
<style>
    label{
        color:black
    }
</style>
  <div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif

<a href="#" data-toggle="modal" data-target="#consultModal" class="btn btn-primary a-btn-slide-text">
  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
  <span><strong>Consult pets</strong></span>            
</a>
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
  </div>
<div class="modal" id="consultModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:75%;">
    <div class="modal-content">
      <div class="modal-header text-center">
        <p class="modal-title w-100 font-weight-bold">Consult Information</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form method="post" action="{{route ('consult.store')}}" >
        {{csrf_field()}}
        <div class="modal-body mx-3" id="inputConsultModal">
            <div class="md-form mb-5"></div>
                <i class="fas fa-cat"></i>
                <label data-error="wrong" data-success="right" for="name"
                                style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Veterinarian</label>
                  {!! Form::select('emp_id', App\Models\Employee::pluck('lname','emp_id'), null,['class' => 'form-control']) !!}
         <div class="md-form mb-5"></div>
            <i class="fas fa-signature"></i>
            <label data-error="wrong" data-success="right" for="name"
            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Observation</label>
        <input type="text" id="observation" class="form-control validate" name="observation">
          <div class="md-form mb-5"></div>
            <i class="fas fa-cat"></i>
            <label data-error="wrong" data-success="right" for="name"
                            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Pet</label>
              {!! Form::select('pet_id', App\Models\Pet::pluck('pname','pet_id'), null,['class' => 'form-control']) !!}
           
          <div class="md-form mb-5"></div>
          <i class="fas fa-dollar-sign"></i>
          <label data-error="wrong" data-success="right" for="name"
          style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Consult cost</label>
            <input type="text" id="consult_cost" class="form-control validate" name="consult_cost">

          <div class="md-form mb-5"></div>
            <i class="fas fa-disease"></i>
            <label data-error="wrong" data-success="right" for="name"
            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Disease</label>
        @foreach($diseases as $disease)
        <div class="form-check form-check-inline">
            {{ Form::checkbox('disease_id[]',$disease->disease_id, null,array('class'=>'form-check-input','disease_id'=>'disease')) }}
            {!!Form::label('disease', $disease->disease_name ,array('class'=>'form-check-label')) !!}
        </div>
    @endforeach

    {{-- <div class="md-form mb-5"></div> --}}
    <div class="modal-footer d-flex justify-content-center">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
    </div>
        </div>
      {!! Form::close() !!}
        </div>
    </div>
</div>
  @push('scripts')
    {{$dataTable->scripts()}}
  @endpush
@endsection