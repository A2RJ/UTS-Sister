@extends('layouts.dashboard')

@section('title', 'Tambah Fakultas')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List fakultas</h4>
    <div class="mb-3">
        <a href="{{ route('faculty.create') }}">
            <button class="btn btn-sm btn-primary">Tambah fakultas</button>
        </a>
    </div>

    <div class="table-resposive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Fakultas</th>
                    <th>Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faculties as $faculty)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $faculty->faculty }}</td>
                    <td>{{ $faculty->humanResource->sdm_name }}</td>
                    <td>
                        <a href="{{ route('faculty.edit', $faculty->id) }}">Edit</a>
                        <form action="{{ route('faculty.destroy', $faculty->id) }}" method="post" onsubmit="return confirm('Yakin hapus {{ $faculty->faculty }}' )">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2 float-right">
            {{ $faculties->links() }}
        </div>
    </div>
</div>
@endsection