@extends('layouts.dashboard')

@section('title', 'List Jabatan Struktural')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List jabatan struktural</h4>
    <div class="mb-3">
        <a href="{{ route('structure.create') }}">
            <button class="btn btn-sm btn-primary">Tambah jabatan struktural</button>
        </a>
        <a href="{{ route('assign.create') }}">
            <button class="btn btn-sm btn-outline-primary">Assign jabatan struktural</button>
        </a>
    </div>

    <x-success-message />
    <x-table :header="['Nama Civitas', 'Jabatan Struktural', 'Berada dibawah', 'Aksi']">
        @foreach ($structures as $structure)
        <tr class="text-capitalize">
            <td>{{ $loop->iteration}}</td>
            <td>
                <ul>
                    @foreach ($structure->humanResource as $civitas)
                    <li>{{ $civitas->sdm_name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $structure->role }} <br> ({{ $structure->type }})</td>
            <td>{{ $structure->child ? $structure->child->role : 'Tidak ada' }}</td>
            <td>
                <a href="{{ route('structure.edit', $structure->id) }}">Edit</a>
                @if ($structure->humanResource)
                @endif
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