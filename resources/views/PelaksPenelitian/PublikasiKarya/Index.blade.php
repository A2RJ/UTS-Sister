@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Publikasi Karya</b>
    <ul>
        @foreach ($data as $publikasiKarya)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('publikasi-karya.detail', ['id' => $publikasiKarya['id']]) }}">
                    {{ $publikasiKarya['kategori_kegiatan'] }} -
                    {{ $publikasiKarya['judul'] }} -
                    {{ $publikasiKarya['quartile'] }}
                    {{ $publikasiKarya['jenis_publikasi'] }}
                    {{ $publikasiKarya['tanggal'] }}
                    {{ $publikasiKarya['asal_data'] }}
                </a>
                <ul>
                    @foreach ($publikasiKarya['bidang_keilmuan'] as $bidang)
                        <li>{{ var_dump($bidang) }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
