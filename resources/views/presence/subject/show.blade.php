@extends('layouts.dashboard')

@section('title', 'List Jadwal Pertemuan')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List jadwal pertemuan: {{ $subject->subject }} ({{ $subject->sks}} SKS)</h4>
    <x-success-message />
    <x-table :header="['Pertemuan' , 'Tanggal', 'Jam Dimulai', 'Foto', 'Aksi']">
        @foreach ($meetings as $meeting)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $meeting->meeting_name }}</td>
            <td>
                @if (!$meeting->date)
                Belum di set oleh prodi
                @else
                {{ $meeting->date }}
                @endif
            </td>
            <td>{{ $meeting->meeting_start }}</td>
            <td>
                @if ($meeting->file)
                <a href="#{{ $meeting->file }}">Foto</a>
                @endif
            </td>
            <td>
                <a href="{{ route('meeting.edit', $meeting->id) }}">Edit</a>
                <x-delete action="{{ route('meeting.destroy', $meeting->id) }}" />
            </td>
        </tr>
        @endforeach
    </x-table>
</div>
@endsection