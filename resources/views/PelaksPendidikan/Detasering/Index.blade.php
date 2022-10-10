@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Detasering</b>
    <ul>
        @foreach ($data as $detasering)
            <li>{{ $loop->iteration }}- {{ $detasering['kategori_kegiatan'] }} -
                {{ $detasering['perguruan_tinggi'] }} -
                {{ $detasering['bidang_tugas'] }} -
                {{ $detasering['sk_penugasan'] }} -
                {{ $detasering['tanggal_sk_penugasan'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
