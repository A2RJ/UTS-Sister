@extends('layouts.dashboard')
@section('content')
<div class="container card p-3">
    <div class="table-responsive">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Method</th>
                    <th>URI</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                <tr>
                    <td>{{ $route->method }}</td>
                    <td>{{ $route->uri }}</td>
                    <td>{{ $route->name }}</td>
                    <td>{{ $route->action }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection