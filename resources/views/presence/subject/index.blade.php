@extends('layouts.dashboard')

@section('title', 'List Mata Kuliah')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List mata kuliah</h4>
    @if (auth()->user()->isStudyProgram())
    <div class="mb-3">
        <a href="{{ route('subject.create') }}">
            <button class="btn btn-sm btn-primary">Tambah mata kuliah</button>
        </a>
    </div>
    @endif
    <x-table :header="['Mata kuliah', 'SKS', 'Jumlah Pertemuan', 'Pertemuan Selesai', 'Pertemuan Selanjutnya', 'Nilai SKS', 'Aksi']">
        @foreach ($subjects as $subject)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $subject->subject }} <br>
                {{ $subject->human_resource->sdm_name }} <br>
                ({{ $subject->class->class }}-{{$subject->class->structure->role}})
            </td>
            <td>{{ $subject->sks }}</td>
            <td>{{ $subject->number_of_meetings }}</td>
            <td>{{ $subject->meetings_completed }}</td>
            <td>{{ $subject->meetings_pending }}</td>
            <td>{{ $subject->value_sks }}</td>
            <td>
                <a href="{{ route('subject.show', $subject->id) }}">Detail</a> <br>
            </td>
        </tr>
        @endforeach
    </x-table>
</div>
@endsection