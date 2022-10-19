@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Pembicara</b>
    <ul>
        @foreach ($data as $pembicara)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('pembicara.detail', ['id' => $pembicara['id']]) }}">
                    {{ $pembicara['judul_makalah'] }} -
                    {{ $pembicara['nama_pertemuan'] }}
                    {{ $pembicara['penyelenggara'] }}
                    {{ $pembicara['tanggal_pelaksanaan'] }}
                </a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
