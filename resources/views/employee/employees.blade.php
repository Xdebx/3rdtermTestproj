@extends('layouts.main')
@section('body')
{{-- @section('content') --}}
  <div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
<div class="col-xs-6">
  <form method="post" enctype="multipart/form-data" action="{{ url('/employee/import') }}">
     @csrf
   <input type="file" id="uploadName" name="employee_upload" required>
</div>
@error('employee_upload')
 <small>{{ $message }}</small>
@enderror
    <button type="submit" class="btn btn-info btn-primary ">Import Excel File</button>
    </form> 
  <div >
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
  </div>
<div class="modal" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Add New Employee</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
 <form  method="POST" action="{{url('employee')}}">
        {{csrf_field()}}
          
<div class="modal-body mx-3" id="inputEmployeeModal">
  
  <div class="md-form mb-5"></div>
    <label data-error="wrong" data-success="right" for="position"
        style="display: inline-block; width: 150px; ">Position</label><i style="color:rgb(0, 132, 255)">*</i>
        <div class="md-form mb-5"> </div>
        <select class="form-control" name="position" id="position">
            <option value="Veterinarian">Veterinarian</option>
            <option value="Assistant">Assistant</option>
            <option value="Groomer">Groomer</option>
        </select>
    </div>
</div>
  <div class="md-form mb-5"> </div>
      <i class="fa-solid fa-compact-disc prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Title</label>
<input type="text" id="title" class="form-control validate" name="title">

  <div class="md-form mb-5"> </div>
      <i class="fa-solid fa-compact-disc prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Fname</label>
  <div class="md-form mb-5"> </div>
<input type="text" id="fname" class="form-control validate" name="lname">
      <i class="fa-solid fa-compact-disc prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; ">Lname</label>
<input type="text" id="lname" class="form-control validate" name="lname">
</div>
    <div class="md-form mb-5">
        <i class="fa-solid fa-guitar prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="addressline" style="display: inline-block;
      width: 150px; ">Address</label>
        <input type="text" id="addressline" class="form-control validate" name="addressline">
      </div>
    <div class="md-form mb-5">
        <i class="fa-solid fa-guitar prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="zipcode" style="display: inline-block;
      width: 150px; ">Zipcode</label>
        <input type="text" id="zipcode" class="form-control validate" name="zipcode">
      </div>
    <div class="md-form mb-5">
        <i class="fa-solid fa-guitar prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="phone" style="display: inline-block;
      width: 150px; ">Phone</label>
        <input type="text" id="phone" class="form-control validate" name="phone">
      </div>
      <div class="md-form mb-5">
        <i class="fa-solid fa-guitar prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="email" style="display: inline-block;
      width: 150px; ">Email</label>
        <input type="text" id="email" class="form-control validate" name="email">
      </div>
      <div class="md-form mb-5">
        <i class="fa-solid fa-guitar prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="password" style="display: inline-block;
      width: 150px; ">Password</label>
        <input type="text" id="password" class="form-control validate" name="password">
      </div>
<div class="modal-footer d-flex justify-content-center">
  <button type="submit" class="btn btn-success">Save</button>
  <button class="btn btn-light" data-dismiss="modal">Cancel</button>
</div>
</form>
</div>
</div>
</div>
@push('scripts')
{{$dataTable->scripts()}}
@endpush
@endsection