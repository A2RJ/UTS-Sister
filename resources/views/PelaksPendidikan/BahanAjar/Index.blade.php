@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Bahan Ajar</b>
    <ul>
        @foreach ($data as $bahanAjar)
            <li>{{ $loop->iteration }}- {{ $bahanAjar['judul'] }} -
                {{ $bahanAjar['isbn'] }} -
                {{ $bahanAjar['nama_jenis'] }} -
                {{ $bahanAjar['nama_penerbit'] }} -
                {{ $bahanAjar['tanggal_terbit'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
