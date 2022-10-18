@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Kepangkatan</b>
        <ul>
            @foreach ($data as $kepangkatan)
                <li>
                    <a href="{{ route('kepangkatan.detail', ['id' => $kepangkatan['id']]) }}">
                        {{ $loop->iteration }}- {{ $kepangkatan['pangkat_golongan'] }} - {{ $kepangkatan['sk'] }} -
                        {{ $kepangkatan['tanggal_mulai'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
