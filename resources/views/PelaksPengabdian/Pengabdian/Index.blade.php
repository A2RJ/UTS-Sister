@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Pengabdian</b>
    <ul>
        @foreach ($data as $pengabdian)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('pengabdian.detail', ['id' => $pengabdian['id']]) }}">
                    {{ $pengabdian['judul'] }} -
                    {{ $pengabdian['tahun_pelaksanaan'] }} -
                    {{ $pengabdian['lama_kegiatan'] }}
                </a>
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
