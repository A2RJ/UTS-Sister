@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Penghargaan</b>
    <ul>
        @foreach ($data as $penghargaan)
            <li>{{ $loop->iteration }} -
                {{ $penghargaan['jenis_penghargaan'] }} -
                {{ $penghargaan['nama'] }}
                {{ $jabatanSktruktural['tahun'] }}
                {{ $jabatanSktruktural['instansi_pemberi'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
