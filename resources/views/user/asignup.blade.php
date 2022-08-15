@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2>Admin Sign Up</h2>
            @if (count($errors) > 0)
                @include('layouts.flash-messages')
            @endif
            <form class="" action="{{ route('user.asignup') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="Name"> First Name: </label>
                    <input type="text" name="fname" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address"> Address: </label>
                    <input type="text" name="addressline" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password"> Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                 <div class="form-group">
                    <label for="image" class="control-label">Admin Image</label>
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