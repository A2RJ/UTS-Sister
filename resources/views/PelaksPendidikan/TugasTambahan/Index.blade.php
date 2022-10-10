@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Tugas Tambahan</b>
    <ul>
        @foreach ($data as $tugasTambahan)
            <li>{{ $loop->iteration }}- {{ $tugasTambahan['jenis_tugas'] }} -
                {{ $tugasTambahan['unit_kerja'] }} -
                {{ $tugasTambahan['perguruan_tinggi'] }} -
                {{ $tugasTambahan['tanggal_mulai_tugas'] }}
                {{ $tugasTambahan['tanggal_selesai_tugas'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
