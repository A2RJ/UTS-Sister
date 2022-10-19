@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Penelitian</b>
    <ul>
        @foreach ($data as $penelitian)
            <li>
                <a href="{{ route('penelitian.detail', ['id' => $penelitian['id']]) }}">
                    {{ $loop->iteration }} - {{ $penelitian['judul'] }} -
                    {{ $penelitian['tahun_pelaksanaan'] }} -
                    {{ $penelitian['lama_kegiatan'] }}
                </a>
                <ul>
                    @foreach ($penelitian['bidang_keilmuan'] as $bidang)
                        <li>{{ var_dump($bidang) }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
