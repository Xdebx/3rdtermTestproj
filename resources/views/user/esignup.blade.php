@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2>Employees Sign Up</h2>
            @if (count($errors) > 0)
                @include('layouts.flash-messages')
            @endif
            <form class="" action="{{ route('user.esignup') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
    <label data-error="wrong" data-success="right" for="position"
        style="display: inline-block; width: 150px; ">Position</label><i style="color:rgb(0, 132, 255)"></i>
        <div class="form-group">
        <select class="form-control" name="position" id="position">
            <option value="Veterinarian">Veterinarian</option>
            <option value="Assistant">Assistant</option>
            <option value="Groomer">Groomer</option>
        </select>
        </div>
        </div>
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
                 <div class="form-group">
                    <label for="image" class="control-label">Employee Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                    <input type="submit" value="Sign Up" class="btn btn-primary">
             </form>
        </div>
    </div>
@endsection