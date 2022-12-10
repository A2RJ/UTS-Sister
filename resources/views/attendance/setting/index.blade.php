@extends('layouts.dashboard')
@section('title', 'Attendace')

@section('content')
<div class="card p-2">
    <p>Ini dari setting</p><br>
    <a href="{{ route('faculty.index') }}">List Fakultas</a> <br>
    <a href="{{ route('study_program.index') }}">List Program studi</a> <br>
    <a href="{{ route('structure.index') }}">List Jabatan Struktural</a> <br>
    <a href="{{ route('sdm.index') }}">List Human resource</a> <br>
    <a href="{{ route('class.index') }}">List Kelas (yang diampuh dosen)</a> <br>
    <a href="{{ route('subject.index') }}">List Mata Kuliah</a> <br>
    <a href="{{ route('meeting.index') }}">List pertemuan mata kuliah</a> <br>
</div>
@endsection