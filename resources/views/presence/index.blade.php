@extends('layouts.dashboard')
@section('title', 'Absensi')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Daftar Absensi Kehadiran</h4>
    @if (url()->current() == route('presence.my-presence'))
    <div class="mb-4">
        <a href="{{ route('presence.absen') }}" class="btn btn-primary btn-block">Tambah izin</a>
        <a href="{{ route('permission.my-presence') }}" class="btn btn-primary btn-block">Daftar izin</a>
    </div>
    @endif

    <x-success-message />
    <x-error-message />

    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="font-weight: bolder; color: black;">Total jam</th>
                    <th style="font-weight: bolder; color: black;">{{ $hours->effective_hours }}</th>
                </tr>
            </thead>
        </table>
    </div>

    <x-search-presence withDate="{{ $withDate ?? false }}" exportUrl="{{ $exportUrl ?? false }}" />
    <x-table :header="['Nama', 'NIDN', 'Jabatan', 'Status Kepegawaian', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Jumlah minimal jam', 'Jumlah jam efektif', 'Jumlah kurang jam', 'Jumlah lebih jam']">
        @foreach ($presences as $index => $presence)
        @php
        $detail = $presence->compareWorkHours(request('start'), request('end'), $presence->sdm_type, $presence)
        @endphp
        <tr>
            <td>{{ $index + $presences->firstItem() }}</td>
            <td>{{ $presence->sdm_name }}</td>
            <td>{{ $presence->nidn }}</td>
            <td>{!! $presence->roles() !!}</td>
            <td>{{ $presence->sdm_type }}</td>
            <td>{{ $presence->checkInDateFormat() }}</td>
            <td>{{ $presence->check_in_hour }}</td>
            <td>{{ $presence->check_out_hour }}</td>
            <td>{{ $detail['targetWorkHours'] }}</td>
            <td>{{ $presence->effective_hours }}</td>
            <td>{{ $detail['less'] }}</td>
            <td>{{ $detail['over'] }}</td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $presences->links() }}
    </div>
</div>
@endsection