@extends('layouts.dashboard')
@section('title', 'Attendace')

@section('content')
<div class="card p-2">
    <p>Ini Dashboard</p><br>
    @if (auth()->user()->isRektor() || auth()->user()->isAdmin())
    <p>Role anda adalah Rektor atau Admin</p>
    @endif

    @if (auth()->user()->isLecturer())
    <p>Role anda adalah Dosen</p>
    @endif

    @if (auth()->user()->isEduStaff())
    <p>Role anda adalah Staff Educational</p>
    @endif

    @if (auth()->user()->hasSub())
    <p>Anda mempunyai Sub divisi</p>
    @endif
</div>
@endsection