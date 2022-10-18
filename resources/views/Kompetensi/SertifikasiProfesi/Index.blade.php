@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Sertifikasi Profesi</b>
        <ul>
            @foreach ($data['profesi'] as $profesi)
                <li>
                    <a href="{{ route('sertifikasi-profesi.detail', ['id' => $profesi['id']]) }}">
                        {{ $loop->iteration }} -
                        {{ $profesi['jenis_sertifikasi'] }} -
                        {{ $profesi['bidang_studi'] }} -
                        {{ $profesi['tahun_sertifikasi'] }} -
                        {{ $profesi['sk_sertifikasi'] }} -
                        {{ $profesi['nomor_registrasi'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <br>

        <b>Sertifikasi Dosen</b>
        <ul>
            @foreach ($data['dosen'] as $dosen)
                <li>
                    <a href="{{ route('sertifikasi-dosen.detail', ['id' => $dosen['id']]) }}">
                        {{ $loop->iteration }} -
                        {{ $dosen['jenis_sertifikasi'] }} -
                        {{ $dosen['bidang_studi'] }} -
                        {{ $dosen['tahun_sertifikasi'] }} -
                        {{ $dosen['sk_sertifikasi'] }} -
                        {{ $dosen['nomor_registrasi'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
