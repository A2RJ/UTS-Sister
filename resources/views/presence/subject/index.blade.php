@extends('layouts.dashboard')

@section('title', 'List Mata Kuliah')

@section('content')
<div class="container p-5 card">
    <div class="mb-4">
        <h4>List mata kuliah</h4>
        <small>Hanya masing-masing program studi yang dapat input mata kuliah.</small>
    </div>
    @if (auth()->user()->isStudyProgram() && Route::currentRouteName() != 'subject.my-subject')
    <div class="mb-3">
        <a href="{{ route('subject.create') }}">
            <button class="btn btn-sm btn-primary">Tambah mata kuliah</button>
        </a>
    </div>
    @endif

    <x-search-subject exportUrl="{{ $exportUrl ?? false }}" />
    <x-table :header="['Mata kuliah', 'Semester', 'SKS', 'Jumlah Pertemuan', 'Pertemuan Selesai', 'Pertemuan Selanjutnya', 'Nilai SKS', 'Aksi']">
        @foreach ($subjects as $subject)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $subject->subject_name }} <br>
                {{ $subject->sdm_name }} <br>
                ({{ $subject->class_name }} - {{$subject->study_program}})
            </td>
            <td>{{ $subject->semester }}</td>
            <td>{{ $subject->sks }}</td>
            <td>{{ $subject->number_of_meetings }}</td>
            <td>{{ $subject->meetings_completed }}</td>
            <td>{{ $subject->meetings_pending }}</td>
            <td>{{ $subject->value_sks }}</td>
            <td>
                <a href="{{ route('subject.show', $subject->id) }}">Detail</a> <br>
                @if (auth()->user()->isStudyProgram())
                <a href="{{ route('subject.edit', $subject->id) }}" class="btn btn-sm btn-outline-warning mr-1 mb-1">Edit</a> <br>
                <x-delete action="{{ route('subject.destroy', $subject->id) }}" />
                @endif
            </td>
        </tr>
        @endforeach
        @if (count($subjects) === 0)
        <tr>
            <td colspan="9" class="text-center">No Data</td>
        </tr>
        @endif
    </x-table>
</div>
@endsection