@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Paten HKI</b>
    <ul>
        @foreach ($data as $paten)
            <li>{{ $loop->iteration }} -
                {{ $paten['kategori_kegiatan'] }} -
                {{ $paten['judul'] }} -
                {{ $paten['quartile'] }}
                {{ $paten['jenis_publikasi'] }}
                {{ $paten['tanggal'] }}
                {{ $paten['asal_data'] }}
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
