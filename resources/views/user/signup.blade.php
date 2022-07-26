@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign Up</h1>
            @if (count($errors) > 0)
                @include('layouts.flash-messages')
            @endif
            <form class="" action="{{ route('user.signup') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title"> Title: </label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Name"> First Name: </label>
                    <input type="text" name="fname" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Name"> Last Name: </label>
                    <input type="text" name="lname" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address"> Address: </label>
                    <input type="text" name="addressline" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="zipcode"> Zipcode: </label>
                    <input type="text" name="zipcode" id="zipcode" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone"> Phone: </label>
                    <input type="text" name="phone" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password"> Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                {{-- <div class="form-group">
                    <label for="pet_id">Role</label>
                    {!! Form::select('role_id', $roles, null, ['placeholder'=>'******Please Choose!******' ,'class' => 'form-control']) !!}
                    @if($errors->has('role_id'))
                    <div class="alert alert-danger">{{ $errors->first('role_id') }}</div>
                   @endif 
                  </div> --}}
                {{-- <div class="form-group">
                    <label for="role"> Role: </label>
                    <input type="role" name="role" id="role" placeholder="customer Or admin" class="form-control">
                </div> --}}

                 <div class="form-group">
                    <label for="image" class="control-label">Customer Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="form-group">
                <label for="role">Choose Role:</label>
                    <select id="role">
                    <option value="customer">Choose ur role here</option>
                    <option value="customer">User</option>
                    <option value="admin">Administrator</option>
                </select>
            </div> --}}
                    <input type="submit" value="Sign Up" class="btn btn-primary">
             </form>
        </div>
    </div>
@endsection