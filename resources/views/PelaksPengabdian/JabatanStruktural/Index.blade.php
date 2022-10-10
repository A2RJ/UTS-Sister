@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Jabatan Struktural</b>
    <ul>
        @foreach ($data as $jabatanSktruktural)
            <li>{{ $loop->iteration }} -
                {{ $jabatanSktruktural['jabatan'] }} -
                {{ $jabatanSktruktural['sk_jabatan'] }}
                {{ $jabatanSktruktural['tanggal_mulai_jabatan'] }}
                {{ $jabatanSktruktural['tanggal_selesai_jabatan'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
