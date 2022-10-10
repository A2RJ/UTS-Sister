@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Penempatan</b>
        <ul>
            @foreach ($data as $penempatan)
                <li>{{ $loop->iteration }}- {{ $penempatan['status_kepegawaian'] }} - {{ $penempatan['ikatan_kerja'] }} -
                    {{ $penempatan['unit_kerja'] }} - {{ $penempatan['jenjang_pendidikan'] }} -
                    {{ $penempatan['perguruan_tinggi'] }} - {{ $penempatan['tanggal_mulai'] }} -
                    {{ $penempatan['tanggal_keluar'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
