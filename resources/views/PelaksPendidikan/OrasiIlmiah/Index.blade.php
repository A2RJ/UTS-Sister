@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Orasi Ilmiah</b>
    <ul>
        @foreach ($data as $orasiIlmiah)
            <li>{{ $loop->iteration }}- {{ $orasiIlmiah['judul_makalah'] }} -
                {{ $orasiIlmiah['nama_pertemuan'] }} -
                {{ $orasiIlmiah['penyelenggara'] }} -
                {{ $orasiIlmiah['tanggal_pelaksanaan'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
