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
        <center><div>
            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#petModal">
                    create new pet</button>
        </div>
    </center>
        {{-- <div>
            {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
        </div> --}}
        <div class="modal" id="petModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" style="width:75%;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <p class="modal-title w-100 font-weight-bold">Add New Pet</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('pet.store')}}" enctype="multipart/form-data" >
                        @csrf
                        <div style="position: absolute; top: -9999px; left: -9999px;">
                        <label data-error="wrong" data-success="right" for="name"
                            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Owner name</label>
        {!! Form::text('customer_id', App\Models\Customer::where('user_id', Auth::id())->pluck('customer_id')->first(),
                                ['readonly'], null,['class' => 'form-control validate',]) !!}
                            </div>
                        <div class="form-group"> 
                            <label data-error="wrong" data-success="right" for="name"
                            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Pet name</label>
                          <input type="text" class="form-control " id="pname" name="pname" value="{{old('pname')}}"placeholder="Pet name">
                          @if($errors->has('pname'))
                          <div class="alert alert-danger">{{ $errors->first('pname') }}</div>
                         @endif 
                        </div>
                      <div class="form-group"> 
                        <label data-error="wrong" data-success="right" for="name"
                        style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Gender</label>
                          <input type="gender" class="form-control" id="gender" name="gender" value="{{old('gender')}}" placeholder="Gender">
                          @if($errors->has('gender'))
                          <div class="alert alert-danger">{{ $errors->first('gender') }}</div>
                         @endif 
                        </div>
                        <div class="form-group"> 
                            <label data-error="wrong" data-success="right" for="name"
                            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Breed</label>
                              <input type="breed" class="form-control" id="breed" name="breed" value="{{old('breed')}}" placeholder="Breed">
                              @if($errors->has('breed'))
                              <div class="alert alert-danger">{{ $errors->first('breed') }}</div>
                             @endif 
                            </div>
                        <div class="form-group"> 
                            <label data-error="wrong" data-success="right" for="name"
                            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Age</label>
                          <input type="number" class="form-control" id="age" name="age" value="{{old('age')}}" placeholder="Age">
                          @if($errors->has('age'))
                          <div class="alert alert-danger">{{ $errors->first('age') }}</div>
                         @endif 
                        </div>
                        <div class="form-group">
                            <label data-error="wrong" data-success="right" for="name"
                            style="display: inline-block; width: 150px; color:rgb(0, 0, 0)">Image</label>
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
    {{-- @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush --}}
@endsection
