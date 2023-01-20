@extends('layouts.dashboard')

@section('title', 'Presensi Kehadiran')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List Absensi Kehadiran</h4>
    @if (auth()->user()->isAdmin())
    <div class="mb-3">
        <a href="{{ route('presence.create') }}">
            <button class="btn btn-sm btn-primary">Absensi Kehadiran</button>
        </a>
    </div>
    @endif
    <x-table :header="['Nama', 'Durasi', 'Aksi']">
        @foreach ($presences as $presence)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $presence->sdm_name }}</td>
            <td>{{ $presence->hours }} Jam {{ $presence->minutes }} Menit</td>
            <td>
                @if (auth()->user()->isAdmin())
                <a href="{{ route('presence.edit', $presence->id) }}">Edit</a> <br>
                @endif
                <a href="{{ route('presence.detail', $presence->id) }}">Detail</a> <br>
            </td>
        </tr>
        @endforeach
    </x-table>
</div>
@endsection