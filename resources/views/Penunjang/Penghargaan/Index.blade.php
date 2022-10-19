@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Penghargaan</b>
    <ul>
        @foreach ($data as $penghargaan)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('penghargaan.detail', ['id' => $penghargaan['id']]) }}">
                    {{ $penghargaan['jenis_penghargaan'] }} -
                    {{ $penghargaan['nama'] }}
                </a>
                {{ $jabatanSktruktural['tahun'] }}
                {{ $jabatanSktruktural['instansi_pemberi'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
