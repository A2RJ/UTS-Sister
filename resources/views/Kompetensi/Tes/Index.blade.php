@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Nilai tes</b>
        <ul>
            @foreach ($data as $sertifikasiProfesi)
                <li>
                    <a href="{{ route('tes.detail', ['id' => $sertifikasiProfesi['id']]) }}">
                        {{ $loop->iteration }} -
                        {{ $sertifikasiProfesi['jenis_tes'] }} -
                        {{ $sertifikasiProfesi['nama'] }} -
                        {{ $sertifikasiProfesi['jenis_tes'] }} -
                        {{ $sertifikasiProfesi['tahun'] }} -
                        {{ $sertifikasiProfesi['skor'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
