@extends('layouts.dashboard')
@section('title', 'Presence')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List Absensi Kehadiran</h4>
    <div class="mb-4">
        <a href="{{ route('presence.absen') }}" class="btn btn-primary btn-block">Input izin</a>
    </div>

    <x-search-presence withDate="{{ $withDate ?? false }}" exportUrl="{{ $exportUrl ?? false }}" />
    <x-table :header="['Nama', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Durasi']">
        @foreach ($presences as $presence)
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $presence->human_resource->sdm_name }}</td>
            <td>{{ $presence->check_in_date != NULL ? $presence->check_in_date : Carbon\Carbon::parse($presence->created_at)->locale('id')->dayName }}</td>
            <td>{{ $presence->check_in_hour }}</td>
            <td>{{ $presence->check_out_hour }}</td>
            <td>{{ $presence->hours }} Jam {{ $presence->minutes }} Menit</td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $presences->links() }}
    </div>
</div>
@endsection