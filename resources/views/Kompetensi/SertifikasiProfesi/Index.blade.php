@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Sertifikasi Profesi</b>
        <ul>
            @foreach ($data as $sertifikasiProfesi)
                <li>{{ $loop->iteration }} -
                    {{ $sertifikasiProfesi['jenis_sertifikasi'] }} -
                    {{ $sertifikasiProfesi['bidang_studi'] }} -
                    {{ $sertifikasiProfesi['tahun_sertifikasi'] }} -
                    {{ $sertifikasiProfesi['sk_sertifikasi'] }} -
                    {{ $sertifikasiProfesi['nomor_registrasi'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
