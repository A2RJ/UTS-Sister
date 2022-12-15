@extends('layouts.dashboard')

@section('title', 'Tambah Pertemuan')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form pertemuan mata kuliah</h4>

    <!-- "subject_id", "meeting_name", 
        "date", "meeting_start", 
        "meeting_end", "file_start", "file_end" -->
    <x-form action="{{ route('meeting.update', $meeting->id) }}" displayError="true">
        @method('PUT')
        <x-select name="subject_id" label="Mata Kuliah" :select="$subjects" :current="$meeting->subject_id" />
        <x-input name="meeting_name" label="Pertemuan ke-n" placeholder="Pertemuan ke-n" :value="$meeting->meeting_name" />
        <x-input name="date" type="datetime-local" label="Tanggal Perkuliahan" :value="$meeting->date" />
        <x-input name="meeting_start" type="datetime-local" label="Mulai Perkuliahan" :value="$meeting->meeting_start" />
        <x-input name="meeting_end" type="datetime-local" label="Selesai Perkuliahan" :value="$meeting->meeting_end" />
        <x-input name="file_start" type="file" label="Foto Mulai Perkuliahan" :value="$meeting->file_start" />
        <x-input name="file_end" type="file" label="Foto Selesai Perkuliahan" :value="$meeting->file_end" />
    </x-form>
</div>
@endsection