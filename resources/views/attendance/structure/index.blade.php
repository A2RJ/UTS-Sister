@extends('layouts.dashboard')

@section('title', 'List Jabatan Struktural')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List jabatan struktural</h4>
    <div class="mb-3">
        <a href="{{ route('structure.create') }}">
            <button class="btn btn-sm btn-primary">Tambah jabatan struktural</button>
        </a>
    </div>

    <x-success-message />
    <x-table :header="['Jabatan Struktural', 'Aksi']">
        @foreach ($structures as $structure)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $structure->role }}</td>
            <td>
                <a href="{{ route('structure.edit', $structure->id) }}">Edit</a>
                <x-delete action="{{ route('structure.destroy', $structure->id) }}" confirm="Yakin hapus {{ $structure->role}}" />
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $structures->links() }}
    </div>
</div>
@endsection