@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Publikasi Jurnal</b>
    <ul>
        @foreach ($data as $publikasiJurnal)
            <li>{{ $loop->iteration }} -
                {{ $publikasiJurnal['media_publikasi'] }} -
                {{ $publikasiJurnal['sk_penugasan'] }}
                {{ $publikasiJurnal['tanggal_mulai'] }}
                {{ $publikasiJurnal['tanggal_selesai'] }}
                {{ $publikasiJurnal['peran'] }}
                {{ $publikasiJurnal['aktif'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
