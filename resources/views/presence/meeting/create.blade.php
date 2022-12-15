@extends('layouts.dashboard')

@section('title', 'Tambah Pertemuan')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form pertemuan mata kuliah</h4>

    <x-form action="{{ route('meeting.store') }}" displayError="true">
        <x-select name="subject_id" label="Mata Kuliah" :select="$subjects" />
        <x-input name="meeting_name" label="Pertemuan ke-n" placeholder="Pertemuan ke-n" />
        <x-input name="date" type="datetime-local" label="Waktu Perkuliahan" />
    </x-form>
</div>
@endsection