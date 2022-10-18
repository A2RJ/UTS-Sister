@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Riwayat Pekerjaan</b>
        <ul>
            @foreach ($data as $riwayatPekerjaan)
                <li>
                    <a href="{{ route('riwayat-pekerjaan.detail', ['id' => $riwayatPekerjaan['id']]) }}">
                        {{ $loop->iteration }}- {{ $riwayatPekerjaan['jenis_pekerjaan'] }} -
                        {{ $riwayatPekerjaan['nama_jabatan'] }} -
                        {{ $riwayatPekerjaan['instansi'] }} -
                        {{ $riwayatPekerjaan['divisi'] }} -
                        {{ $riwayatPekerjaan['mulai_bekerja'] }} -
                        {{ $riwayatPekerjaan['selesai_bekerja'] }} -
                        {{ $riwayatPekerjaan['luar_negeri'] }} -
                        {{ $riwayatPekerjaan['bidang_usaha'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
