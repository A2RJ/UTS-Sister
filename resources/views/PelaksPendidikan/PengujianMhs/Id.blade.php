@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    {{ var_dump($data->body()) }}
@endsection
