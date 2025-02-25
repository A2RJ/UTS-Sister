@extends('layouts.dashboard')
@section('title', 'Absensi')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Daftar Absensi Kehadiran</h4>

    <div class="table-responsive mb-4">
        <small>Total jam secara default 1 minggu kalender, pilih range sesuai kebutuhan</small>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="font-weight: bolder; color: black;">Total jam</th>
                    <th style="font-weight: bolder; color: black;">{{ $hours->effective_hours }}</th>
                </tr>
            </thead>
        </table>
    </div>

    <small>Tambahkan titik dua (:) pada karakter pertama untuk mencari tipe sdm, seperti :dosen, :tenaga kependidikan</small>
    <form class="mb-4 mt-1" action="{{ url()->current() }}" method="GET">
        <div class="input-group">
            <input type="text" name="search" class="form-control" value="{{ request('search')}}" placeholder="Search..." autocomplete="off">

            @if ($withDate)
            <input type="date" name="start" class="form-control" value="{{ request('start')}}">
            <input type="date" name="end" class="form-control" value="{{ request('end')}}">
            @endif

            <select class="form-select" name="filter" id="filter">
                <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Pilih filter</option>
                <option value="per-unit" {{ request('filter') == 'per-unit' ? 'selected' : '' }}>Per unit</option>
                <option value="per-civitas" {{ request('filter') == 'per-civitas' ? 'selected' : '' }}>Per civitas</option>
            </select>

            <select class="form-select" name="one-level" id="one-level">
                <option value="" {{ request('one-level') == '' ? 'selected' : '' }}>Pilih divisi</option>
                <option value="1" {{ request('one-level') == '1' ? 'selected' : '' }}>Satu level dibawah</option>
            </select>

            <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
            <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
            @if ($exportUrl)
            <a href="{{ $exportUrl }}" target="_blank" class="btn btn-sm btn-outline-primary">Export</a>
            @endif
        </div>
    </form>

    @if (request('filter') === 'per-unit')
    <x-table :header="['Nama Unit']">
        @foreach ($presences as $index => $unit)
        <tr>
            <td>{{ $index + $presences->firstItem() }}</td>
            <td>{{ $unit->role }}</td>
            <td><a href="{{ route('presence.per-unit', $unit->id) }}">Detail</a></td>
        </tr>
        @endforeach
    </x-table>
    @elseif (request('filter') === 'per-civitas')
    <x-table :header="['Nama', 'NIDN', 'Jabatan', 'Status Kepegawaian', 'Jumlah minimal jam', 'Jumlah jam efektif', 'Jumlah kurang jam', 'Denda', 'Jumlah lebih jam', 'Aksi']">
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
            <td>{{ $detail['targetWorkHours'] }}</td>
            <td>{{ $presence->effective_hours }}</td>
            <td>{{ $detail['less'] }}</td>
            <td>{{ request('start') ? money($detail['penalty'], 'IDR', true) : money(0, 'IDR', true) }}</td>
            <td>{{ $detail['over'] }}</td>
            <td><a href="{{ route('presence.per-civitas', ['sdm_id' => $presence->id]) }}">Detail</a></td>
        </tr>
        @endforeach
    </x-table>
    @else
    <x-table :header="['Nama', 'NIDN', 'Jabatan', 'Status Kepegawaian', 'Tanggal', 'Jam Masuk', 'Jam Pulang', 'Jumlah minimal jam', 'Jumlah jam efektif', 'Jumlah kurang jam', 'Denda', 'Jumlah lebih jam']">
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
            <td>{{ money($detail['penalty'], 'IDR', true) }}</td>
            <td>{{ $detail['over'] }}</td>
        </tr>
        @endforeach
    </x-table>
    @endif
    <div class="mt-2 float-right">
        {{ $presences->links() }}
    </div>
</div>
@endsection