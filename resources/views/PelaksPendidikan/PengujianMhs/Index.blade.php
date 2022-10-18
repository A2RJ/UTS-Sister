@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Pengujian Mahasiswa</b>
        <ul>
            @foreach ($data as $pengujianMahasiswa)
                <li>
                    <a href="{{ route('pengujian-mahasiswa.detail', ['id' => $pengujianMahasiswa['id']]) }}">
                        {{ $loop->iteration }}- {{ $pengujianMahasiswa['id_katgiat'] }} -
                        {{ $pengujianMahasiswa['judul'] }} -
                        {{ $pengujianMahasiswa['jenis_pengujian'] }} - {{ $pengujianMahasiswa['program_studi'] }}-
                        {{ $pengujianMahasiswa['semester'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
