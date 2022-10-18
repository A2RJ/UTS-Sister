@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Bimbingan Dosen</b>
    <ul>
        @foreach ($data as $bimbinganDosen)
            <li>
                <a href="{{ route('pembimbing-dosen.detail', ['id' => $bimbinganDosen['id']]) }}">
                    {{ $loop->iteration }}- {{ $bimbinganDosen['nama_pembimbing'] }} -
                    {{ $bimbinganDosen['nama_bimbing'] }} -
                    {{ $bimbinganDosen['tanggal_mulai'] }} -
                    {{ $bimbinganDosen['tanggal_selesai'] }}</a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
