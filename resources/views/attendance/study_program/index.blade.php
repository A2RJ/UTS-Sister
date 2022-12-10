@extends('layouts.dashboard')

@section('title', 'List Program studi')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List program studi</h4>
    <div class="mb-3">
        <a href="{{ route('study_program.create') }}">
            <button class="btn btn-sm btn-primary">Tambah program studi</button>
        </a>
    </div>

    <x-success-message />
    <x-table :header="['Fakultas', 'Program studi', 'Aksi']">
        @foreach ($study_programs as $study_program)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $study_program->faculty->faculty }}</td>
            <td>{{ $study_program->study_program }}</td>
            <td>
                <a href="{{ route('study_program.edit', $study_program->id) }}">Edit</a>
                <x-delete action="{{ route('study_program.destroy', $study_program->id) }}" />
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $study_programs->links() }}
    </div>
</div>
@endsection