@extends('layouts.dashboard')

@section('title', 'List Jadwal Pertemuan Mata Kuliah')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List jadwal mata kuliah</h4>
    <div class="mb-3">
        <a href="{{ route('meeting.create') }}">
            <button class="btn btn-sm btn-primary">Tambah jadwal</button>
        </a>
    </div>

    <x-success-message />
    <x-error-message />
    <x-table :header="['Mata Kuliah', 'Pertemuan' , 'Waktu' , 'Jam Dimulai' , 'Jam Diakhiri' , 'Foto Mulai' , 'Foto Selesai', 'Aksi']">
        @foreach ($meetings as $meeting)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $meeting->subject->subject }}</td>
            <td>{{ $meeting->meeting_name }}</td>
            <td>{{ $meeting->date ? date("Y-m-d H:i", strtotime($meeting->date)) : '' }}</td>
            <td>{{ $meeting->meeting_start }}</td>
            <td>{{ $meeting->meeting_end }}</td>
            <td><a href="#{{ $meeting->file_start }}">Foto Mulai</a></td>
            <td><a href="#{{ $meeting->file_end }}">Foto Selesai</a></td>
            <td>
                <a href="{{ route('meeting.edit', $meeting->id) }}" class="btn btn-sm btn-outline-warning mr-1 mb-1">Edit</a>
                <x-delete action="{{ route('meeting.destroy', $meeting->id) }}" />
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $meetings->links() }}
    </div>
</div>
@endsection