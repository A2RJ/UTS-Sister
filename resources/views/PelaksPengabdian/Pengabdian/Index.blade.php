@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Pengabdian</b>
    <ul>
        @foreach ($data as $pengabdian)
            <li>{{ $loop->iteration }} - {{ $pengabdian['judul'] }} -
                {{ $pengabdian['tahun_pelaksanaan'] }} -
                {{ $pengabdian['lama_kegiatan'] }}
                <ul>
                    @foreach ($pengabdian['bidang_keilmuan'] as $bidang)
                        <li>{{ var_dump($bidang) }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
