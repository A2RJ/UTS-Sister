@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Tugas Tambahan</b>
    <ul>
        @foreach ($data as $tugasTambahan)
            <li>
                <a href="{{ route('tugas-tambahan.detail', ['id' => $tugasTambahan['id']]) }}">
                    {{ $loop->iteration }}- {{ $tugasTambahan['jenis_tugas'] }} -
                    {{ $tugasTambahan['unit_kerja'] }} -
                    {{ $tugasTambahan['perguruan_tinggi'] }} -
                    {{ $tugasTambahan['tanggal_mulai_tugas'] }}
                    {{ $tugasTambahan['tanggal_selesai_tugas'] }}
                </a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
