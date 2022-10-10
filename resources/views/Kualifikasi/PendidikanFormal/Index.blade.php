@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Pendidikan Formal</b>
        <ul>
            @foreach ($data as $pendidikanFormal)
                <li>{{ $loop->iteration }}- {{ $pendidikanFormal['jenjang_pendidikan'] }} -
                    {{ $pendidikanFormal['gelar_akademik'] }} -
                    {{ $pendidikanFormal['bidang_studi'] }} - {{ $pendidikanFormal['nama_perguruan_tinggi'] }}-
                    {{ $pendidikanFormal['tahun_lulus'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
