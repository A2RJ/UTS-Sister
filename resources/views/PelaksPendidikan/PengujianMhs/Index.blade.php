@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Pengujian Mahasiswa</b>
        <ul>
            @foreach ($data as $pengujianMahasiswa)
                <li>{{ $loop->iteration }}- {{ $pengujianMahasiswa['id_katgiat'] }} -
                    {{ $pengujianMahasiswa['judul'] }} -
                    {{ $pengujianMahasiswa['jenis_pengujian'] }} - {{ $pengujianMahasiswa['program_studi'] }}-
                    {{ $pengujianMahasiswa['semester'] }} -
                </li>
            @endforeach
        </ul>
    </div>
@endsection
