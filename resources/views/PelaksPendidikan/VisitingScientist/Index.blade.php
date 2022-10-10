@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Visiting scientist</b>
    <ul>
        @foreach ($data as $visitingScientist)
            <li>{{ $loop->iteration }}- {{ $visitingScientist['perguruan_tinggi'] }} -
                {{ $visitingScientist['lama_kegiatan'] }} -
                {{ $visitingScientist['tanggal'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
