@extends('layouts.dashboard')
@section('title', 'Presence')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List izin kehadiran</h4>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <x-table :header="['Nama', 'Tanggal', 'Detail', 'File', 'Aksi']">
        @foreach ($permissions as $permission)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $permission->sdm_name }}</td>
            <td>{{ $permission->created_at }}</td>
            <td>{{ $permission->attachment->detail }}</td>
            <td>{{ $permission->attachment->attachment }}</td>
            <td>
                <form method="POST" action="{{ route('presence.confirm', ['presence' => $permission->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block">Terima</button>
                </form>
                <a href="{{ route('presence.sub.permission') }}" class="btn btn-danger btn-block">Tolak</a>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $permissions->links() }}
    </div>
</div>
@endsection