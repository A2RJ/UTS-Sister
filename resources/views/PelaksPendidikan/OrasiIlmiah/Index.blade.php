@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Orasi Ilmiah</b>
    <ul>
        @foreach ($data as $orasiIlmiah)
            <li>
                <a href="{{ route('orasi-ilmiah.detail', ['id' => $orasiIlmiah['id']]) }}">
                    {{ $loop->iteration }}- {{ $orasiIlmiah['judul_makalah'] }} -
                    {{ $orasiIlmiah['nama_pertemuan'] }} -
                    {{ $orasiIlmiah['penyelenggara'] }} -
                    {{ $orasiIlmiah['tanggal_pelaksanaan'] }}
                </a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
