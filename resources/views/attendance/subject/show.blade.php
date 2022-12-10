@extends('layouts.dashboard')

@section('title', 'List Jadwal Pertemuan')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List jadwal pertemuan: {{ $subject->subject }}</h4>
    <!-- 'Mata Kuliah',  -->
    <x-success-message />
    <x-table :header="['Pertemuan' , 'Waktu' , 'Jam Dimulai' , 'Jam Diakhiri' , 'Foto Mulai' , 'Foto Selesai', 'Aksi']">
        @if ($subject->meetings->count())
        @foreach ($subject->meetings as $meeting)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <!-- <td>{{ $meeting->subject->subject }}</td> -->
            <td>{{ $meeting->meeting_name }}</td>
            <td>{{ $meeting->date }}</td>
            <td>{{ $meeting->meeting_start }}</td>
            <td>{{ $meeting->meeting_end }}</td>
            <td>{{ $meeting->file_start }}</td>
            <td>{{ $meeting->file_end }}</td>
            <td>
                <a href="{{ route('meeting.edit', $meeting->id) }}">Edit</a>
                <x-delete action="{{ route('meeting.destroy', $meeting->id) }}" />
            </td>
        </tr>
        @endforeach
        @endif
    </x-table>
</div>
@endsection