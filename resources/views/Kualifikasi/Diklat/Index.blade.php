@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Diklat</b>
        <ul>
            @foreach ($data as $diklat)
                <li>{{ $loop->iteration }}- {{ $diklat['jenis_diklat'] }} - {{ $diklat['nama'] }} -
                    {{ $diklat['penyelenggara'] }} -
                    {{ $diklat['tahun_lulus'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
