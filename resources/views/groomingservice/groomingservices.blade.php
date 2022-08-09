@extends('layouts.main')
@section('body')
    {{-- @section('content') --}}
    <div class="container">
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif
        {{-- <div>
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#serviceModal">
                    create new Grooming Services</button>
          
        </div> --}}
        <div class="col-xs-6">
            <form method="post" enctype="multipart/form-data" action="{{ url('/Grooming/import') }}">
                @csrf
                <input type="file" id="uploadName" name="grooming_upload" required>
        </div>
        @error('grooming_upload')
            <small>{{ $message }}</small>
        @enderror
        <button type="submit" class="btn btn-info btn-primary ">Import Excel File</button>
        </form>
        <a href="#" data-toggle="modal" data-target="#serviceModal" class="btn btn-primary a-btn-slide-text">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            <span><strong>Add new grooming</strong></span>            
        </a>
        <div>
            {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
        </div>
        <div class="modal" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:75%;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <p class="modal-title w-100 font-weight-bold">Add New Grooming Service</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('grooming.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="modal-body mx-3" id="inputServiceModal">
                            <div class="md-form mb-5"> </div>
                            <label data-error="wrong" data-success="right" for="name"
                                style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Service Name</label>
                            <input type="text" id="service_name" class="form-control validate" name="service_name">

                            <div class="md-form mb-5"></div>
                            <label data-error="wrong" data-success="right" for="name"
                                style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Service Cost</label>
                            <input type="text" id="service_cost" class="form-control validate" name="service_cost">

                        <div class="md-form mb-5"> </div>
                        <label for="image" class="control-label" style="color:rgb(0, 0, 0)">Customer Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
