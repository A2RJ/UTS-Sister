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

                    <h5 class="mb-3">Nama: {{ Auth::user()->sdm_name }}</h5>
                    <small>Sister ID: {{ session('id_sdm') }}</small>

                    <div class="mb-2">
                        @if (auth()->user()->isDirAkademik())
                        <p>Role and adalah Dir Akademik</p>
                        @endif

                        @if (auth()->user()->isMissingRole())
                        <p>Hubungi admin karena role anda tidak di assign</p>
                        @endif

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

                        @if (auth()->user()->isDSDM())
                        <p>Role anda adalah DSDM</p>
                        @endif

                    </div>

                    @if (count(auth()->user()->hasSub()))
                    <p>Anda mempunyai Sub divisi</p>
                    <ul>
                        @foreach (auth()->user()->hasSub() as $item)
                        <li>{{ $item->role }} - {{ $item->type }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection