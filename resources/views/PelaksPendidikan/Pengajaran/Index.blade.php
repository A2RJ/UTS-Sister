@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Pengajaran</b>
        <ul>
            @foreach ($data as $pengajaran)
                <li>{{ $loop->iteration }}- {{ $pengajaran['semester'] }} -
                    {{ $pengajaran['mata_kuliah'] }} -
                    {{ $pengajaran['kelas'] }} - {{ $pengajaran['jumlah_mahasiswa'] }}-
                    {{ $pengajaran['sks'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
