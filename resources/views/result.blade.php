@extends('layout')
@section('body')
    <a href="{{route('panel')}}">Back to Panel</a>
    <div>
        <pre>
        {!! $result !!}
        </pre>
    </div>
@endsection
