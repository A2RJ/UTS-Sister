@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Bimbingan Mahasiswa</b>
        <ul>
            @foreach ($data as $bimbinganMahasiswa)
                <li>
                    <a href="{{ route('bimbingan-mahasiswa.detail', ['id' => $bimbinganMahasiswa['id']]) }}">
                        {{ $loop->iteration }}- {{ $bimbinganMahasiswa['id_katgiat'] }} -
                        {{ $bimbinganMahasiswa['judul'] }} -
                        {{ $bimbinganMahasiswa['jenis_bimbingan'] }} - {{ $bimbinganMahasiswa['program_studi'] }}-
                        {{ $bimbinganMahasiswa['semester'] }} -
                        {{ $bimbinganMahasiswa['nm_kat'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
