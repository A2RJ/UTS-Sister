@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Paten HKI</b>
    <ul>
        @foreach ($data as $paten)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('paten-hki.detail', ['id' => $paten['id']]) }}">
                    {{ $paten['kategori_kegiatan'] }} -
                    {{ $paten['judul'] }} -
                    {{ $paten['quartile'] }}
                    {{ $paten['jenis_publikasi'] }}
                    {{ $paten['tanggal'] }}
                    {{ $paten['asal_data'] }}
                </a>
                <ul>
                    @foreach ($paten['bidang_keilmuan'] as $bidang)
                        <li>{{ var_dump($bidang) }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
