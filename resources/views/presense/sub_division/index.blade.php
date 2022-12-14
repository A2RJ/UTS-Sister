@extends('layouts.dashboard')
@section('title', 'Absensi Civitas')

@section('content')
<div class="card p-2">
    <h3>List Pengajaran</h3>
    @foreach ($lecturers as $lecturer)
    <p>{{ $lecturer->sdm_name }} - {{ $lecturer->structure->type }} - {{ $lecturer->structure->role }}</p>
    @endforeach
    <h3>List Kehadiran</h3>
    @foreach ($attendances as $presence)
    <p>{{ $presence->sdm_name }} - {{ $presence->structure->type }} - {{ $presence->structure->role }}</p>
    @endforeach
</div>
@endsection