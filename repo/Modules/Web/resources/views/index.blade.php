@extends('web::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('web.name') !!}</p>
@endsection
