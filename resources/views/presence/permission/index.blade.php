@extends('layouts.dashboard')
@section('title', 'Presence')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List izin kehadiran</h4>

    <x-success-message />
    <x-error-message />

    <x-table :header="['Nama', 'Tanggal', 'Detail', 'File', 'Aksi']">
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $permission->sdm_name }}</td>
            <td>{{ $permission->created_at }}</td>
            <td>{{ $permission->attachment->detail }}</td>
            <td>
                @if ($permission->attachment->attachment)
                <a href="{{ asset('presense/attachments/' . $permission->attachment->attachment) }}">File</a>
                @endif
            </td>
            <td>
                @if ($permission->sdm_id != auth()->user()->id)
                <form method="POST" class="mb-1 mr-1" action="{{ route('presence.confirm', ['presence' => $permission->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block">Terima</button>
                </form>
                @endif
                <form method="POST" action="{{ route('presence.delete', ['presence' => $permission->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-block">
                        @if ($permission->sdm_id != auth()->user()->id)
                        Tolak
                        @else
                        Hapus
                        @endif

                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $permissions->links() }}
    </div>
</div>
@endsection