@extends('layouts.dashboard')
@section('title', 'Presence')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Daftar izin kehadiran</h4>

    <x-success-message />
    <x-error-message />

    <x-table :header="['Nama', 'Jabatan', 'Tanggal', 'Detail', 'File', 'Aksi']">
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $permission->sdm_name }}</td>
            <td>{!! $permission->roles() !!}</td>
            <td>{{ $permission->created_at }}</td>
            <td>{!! $permission->detail() !!}</td>
            <td>
                @if ($permission->attachment->attachment)
                <a href="{{ route('download.presense', ['filename' => $permission->attachment->attachment]) }}">File</a>
                @endif
            </td>
            <td>
                @if ($permission->sdm_id != auth()->user()->id)
                <form method="POST" class="mb-1 mr-1" action="{{ route('presence.confirm', ['presence' => $permission->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block">Terima</button>
                </form>
                <form method="POST" action="{{ route('presence.decline', ['presence' => $permission->id]) }}" onsubmit="return confirm('Apakah Anda yakin ingin menolak permintaan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block">
                        Tolak
                    </button>
                </form>
                @else
                <form method="POST" action="{{ route('presence.destroy', ['presence' => $permission->id]) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permintaan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block">
                        Hapus
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $permissions->links() }}
    </div>
</div>
@endsection