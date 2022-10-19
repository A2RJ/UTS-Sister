@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Publikasi Jurnal</b>
    <ul>
        @foreach ($data as $publikasiJurnal)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('penglola-jurnal.detail', ['id' => $publikasiJurnal['id']]) }}">
                    {{ $publikasiJurnal['media_publikasi'] }} -
                    {{ $publikasiJurnal['sk_penugasan'] }}
                    {{ $publikasiJurnal['tanggal_mulai'] }}
                    {{ $publikasiJurnal['tanggal_selesai'] }}
                    {{ $publikasiJurnal['peran'] }}
                    {{ $publikasiJurnal['aktif'] }}
                </a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
