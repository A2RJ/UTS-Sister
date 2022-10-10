@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Nilai tes</b>
        <ul>
            @foreach ($data as $sertifikasiProfesi)
                <li>{{ $loop->iteration }} -
                    {{ $sertifikasiProfesi['jenis_tes'] }} -
                    {{ $sertifikasiProfesi['nama'] }} -
                    {{ $sertifikasiProfesi['jenis_tes'] }} -
                    {{ $sertifikasiProfesi['tahun'] }} -
                    {{ $sertifikasiProfesi['skor'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
