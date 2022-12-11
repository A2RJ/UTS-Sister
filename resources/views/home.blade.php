@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in') }}: {{ Auth::user()->sdm_name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection