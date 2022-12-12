@extends('layouts.dashboard')

@section('title', 'List Jadwal Pertemuan')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List jadwal pertemuan: {{ $subject->subject }} ({{ $subject->sks}} SKS)</h4>
    <x-success-message />
    <x-table :header="['Pertemuan' , 'Tanggal', 'Jam Dimulai', 'Jam Diakhiri', 'Estimasi Perkuliahan','Foto Mulai', 'Foto Selesai', 'Aksi']">
        @foreach ($meetings as $meeting)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $meeting->meeting_name }}</td>
            <td>{{ $meeting->date }}</td>
            <td>{{ $meeting->meeting_start }}</td>
            <td>{{ $meeting->meeting_end }}</td>
            <td>{{ $meeting->meeting_duration }} Menit</td>
            <td><a href="#{{ $meeting->file_start }}">Foto Mulai</a></td>
            <td><a href="#{{ $meeting->file_end }}">Foto Selesai</a></td>
            <td>
                <a href="{{ route('meeting.edit', $meeting->id) }}">Edit</a>
                <x-delete action="{{ route('meeting.destroy', $meeting->id) }}" />
            </td>
        </tr>
        @endforeach
    </x-table>
</div>
@endsection