@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Pembicara</b>
    <ul>
        @foreach ($data as $pembicara)
            <li>{{ $loop->iteration }} -
                {{ $pembicara['judul_makalah'] }} -
                {{ $pembicara['nama_pertemuan'] }}
                {{ $pembicara['penyelenggara'] }}
                {{ $pembicara['tanggal_pelaksanaan'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
