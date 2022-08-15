{{-- @extends('layouts.main')
@section('contents')
<div>
    {{$dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true)}}
</div>
@push('scripts')
{{ $dataTable->scripts() }}
@endpush
@endsection --}}


@extends('layouts.main')
@section('body')
    <div class="container">
        <br />
        @if (Session::has('success'))
            <div class="alert alert-success">
                <p>{{ Session::get('success') }}</p>
            </div><br />
        @endif
        <div>
            {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
        </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
