@extends('layouts.dashboard')
@section('title', 'Detail Absensi')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List absensi: {{ $sdm->sdm_name }}</h4>

    <x-table :header="['Tanggal Masuk', 'Tanggal Pulang', 'Total Jam']">
        @foreach ($structural as $presence)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $presence->check_in_date }} {{ $presence->check_in_hour }}</td>
            <td>{{ $presence->check_out_date }} {{ $presence->check_out_hour }}</td>
            <td>{{ $presence->hours }} Jam {{ $presence->minutes }} Menit</td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $structural->links() }}
    </div>
</div>
@endsection