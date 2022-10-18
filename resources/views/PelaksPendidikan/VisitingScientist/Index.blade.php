@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Visiting scientist</b>
    <ul>
        @foreach ($data as $visitingScientist)
            <li>
                <a href="{{ route('visiting-scientist.detail', ['id' => $visitingScientist['id']]) }}">
                    {{ $loop->iteration }}- {{ $visitingScientist['perguruan_tinggi'] }} -
                    {{ $visitingScientist['lama_kegiatan'] }} -
                    {{ $visitingScientist['tanggal'] }}
                </a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
