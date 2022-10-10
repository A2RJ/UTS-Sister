@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Bimbingan Dosen</b>
    <ul>
        @foreach ($data as $bimbinganDosen)
            <li>{{ $loop->iteration }}- {{ $bimbinganDosen['nama_pembimbing'] }} -
                {{ $bimbinganDosen['nama_bimbing'] }} -
                {{ $bimbinganDosen['tanggal_mulai'] }} -
                {{ $bimbinganDosen['tanggal_selesai'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
