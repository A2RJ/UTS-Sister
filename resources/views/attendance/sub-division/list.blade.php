@extends('layouts.dashboard')
@section('title', 'List Sub Divisi')

@section('content')
<div class="card p-2">
    list sub divisi <br>
    @foreach ($subdivision as $sub)
    <p>{{ $sub->role }}</p>
    @endforeach
</div>
@endsection