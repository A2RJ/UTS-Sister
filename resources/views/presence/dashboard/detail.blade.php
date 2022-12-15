@extends('layouts.dashboard')
@section('title', 'Detail Absensi')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List absensi: {{ $sdm->sdm_name }}</h4>

    <x-table :header="['Tanggal Masuk', 'Tanggal Pulang', 'Total Jam']">
        @foreach ($structural as $sub)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sub->check_in_hour }} - {{ $sub->check_in_date }}</td>
            <td>{{ $sub->check_out_hour }} - {{ $sub->check_out_date }}</td>
            <td>{{ $sub->hours }} Jam {{ $sub->minutes }} Menit</td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $structural->links() }}
    </div>
</div>
@endsection