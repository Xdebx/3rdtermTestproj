@extends('layouts.main')
@section('content')
<style >
 .login-box{
    background: linear-gradient(#141e30, #243b55);
    color: #FFFFFF;
    }
</style>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @if (count($errors) > 0)
                @include('layouts.flash-messages')
            @endif
            <div class="login-box">
                 <h2>Sign in</h2>
            <form class="" action="{{ route('user.signin') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="user-box">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                    @if($errors->has('email'))
                    <div class="error">{{ $errors->first('email') }}</div>
                @endif
                </div>
               <div class="user-box">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" class="form-control">
                    @if($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                @endif
                </div>
                     <input type="submit" value="SignIn" class="btn btn-primary">
             </form>
        </div>
    </div>
@endsection




{{-- @extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1>Sign In</h1>
            @if (count($errors) > 0)
                @include('layouts.flash-messages')
            @endif
            <form class="" action="{{ route('user.signin') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                    @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                    <input type="submit" value="Sign In" class="btn btn-primary">
             </form>
        </div>
    </div>
@endsection --}}
