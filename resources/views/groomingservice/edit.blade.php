@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Edit Grooming Service section</h2>
        {{ Form::model($groomingservice, ['route' => ['grooming.update', $groomingservice->service_id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}

        <div class="form-group">
            <label for="service_name" class="control-label">Service Name: </label>
            {{ Form::text('service_name', null, ['class' => 'form-control', 'service_id' => 'service_name']) }}
            @if ($errors->has('service_name'))
                <small>{{ $errors->first('service_name') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="service_cost" class="control-label">Service Cost: </label>
            {{ Form::text('service_cost', null, ['class' => 'form-control', 'service_id' => 'service_cost']) }}
            @if ($errors->has('service_cost'))
                <small>{{ $errors->first('service_cost') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="control-label">Service Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset('images/' . $groomingservice->img_path) }}" width="100" height="100" class="img-circle"
                enctype="multipart/form-data" />
            @if ($errors->has('img_path'))
                <div class="alert alert-danger">{{ $errors->first('img_path') }}</div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-default" role="button">Cancel</a>
    </div>
    </div>
    {!! Form::close() !!}
@endsection
