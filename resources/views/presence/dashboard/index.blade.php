@extends('layouts.dashboard')
@section('title', 'Presence')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List Absensi Kehadiran</h4>
    @if (Route::currentRouteName() == 'presence.my-presence')
    <div class="mb-4">
        <a href="{{ route('presence.absen') }}" class="btn btn-primary btn-block">Input izin</a>
        <a href="{{ route('presence.my-absen') }}" class="btn btn-primary btn-block">List izin</a>
    </div>
    @endif
    @php
    $hours = $hours ?? collect();
    @endphp
    @if (count($hours))
    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Total jam</th>
                    <th>Kurang jam</th>
                    <th>Lebih jam</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hours as $hour)
                <tr>
                    <td>{{ $hour->hours }} Jam dan {{ $hour->minutes }} Menit</td>
                    <td>{{ $hour->hour_difference }} Jam dan {{ $hour->minute_difference }} Menit</td>
                    <td>{{ $hour->overtime_hours }} Jam dan {{ $hour->overtime_minutes }} Menit</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

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