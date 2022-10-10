@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Kepangkatan</b>
        <ul>
            @foreach ($data as $kepangkatan)
                <li>{{ $loop->iteration }}- {{ $kepangkatan['pangkat_golongan'] }} - {{ $kepangkatan['sk'] }} -
                    {{ $kepangkatan['tanggal_mulai'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
