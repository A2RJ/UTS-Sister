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

                    {{ Auth::user() }}

                    <div>
                        <p>Ini Dashboard</p>

                        @if (auth()->user()->isRektor())
                        <p>Role anda adalah Rektor</p>
                        @endif

                        @if (auth()->user()->isAdmin())
                        <p>Role anda adalah Admin</p>
                        @endif

                        @if (auth()->user()->isFaculty())
                        <p>Role anda adalah dekan fakultas</p>
                        @endif

                        @if (auth()->user()->isStudyProgram())
                        <p>Role anda adalah ka prodi</p>
                        @endif

                        @if (auth()->user()->isLecturer())
                        <p>Role anda adalah Dosen</p>
                        @endif

                        @if (auth()->user()->isStructural())
                        <p>Role anda adalah Struktural</p>
                        @endif

                        @if (count(auth()->user()->hasSub()))
                        <p>Anda mempunyai Sub divisi</p>
                        @foreach (auth()->user()->hasSub() as $item)
                        <p>{{ $item->role }} - {{ $item->type }}</p>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection