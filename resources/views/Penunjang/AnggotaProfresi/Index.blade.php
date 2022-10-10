@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Anggota Profesi</b>
    <ul>
        @foreach ($data as $anggotaProfesi)
            <li>{{ $loop->iteration }} -
                {{ $anggotaProfesi['nama_organisasi'] }} -
                {{ $anggotaProfesi['peran'] }}
                {{ $jabatanSktruktural['tanggal_mulai_keanggotaan'] }}
                {{ $jabatanSktruktural['tanggal_selesai_keanggotaan'] }}
                {{ $jabatanSktruktural['instansi_profesi'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
