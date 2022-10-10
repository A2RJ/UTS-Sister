@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Bimbingan Mahasiswa</b>
        <ul>
            @foreach ($data as $bimbinganMahasiswa)
                <li>{{ $loop->iteration }}- {{ $bimbinganMahasiswa['id_katgiat'] }} -
                    {{ $bimbinganMahasiswa['judul'] }} -
                    {{ $bimbinganMahasiswa['jenis_bimbingan'] }} - {{ $bimbinganMahasiswa['program_studi'] }}-
                    {{ $bimbinganMahasiswa['semester'] }} -
                    {{ $bimbinganMahasiswa['nm_kat'] }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
