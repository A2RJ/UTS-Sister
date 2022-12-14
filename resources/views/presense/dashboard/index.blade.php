@extends('layouts.dashboard')
@section('title', 'Attendace')

@section('content')
<div class="card p-2">
    <p>Ini Dashboard</p>

    <p>
        {{ auth()->user()->childrens }}
    </p>

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

    @if (auth()->user()->hasSub())
    <p>Anda mempunyai Sub divisi</p>
    @foreach (auth()->user()->hasSub() as $item)
    <p>{{ $item->role }} - {{ $item->type }}</p>
    @endforeach
    @endif
</div>
@endsection