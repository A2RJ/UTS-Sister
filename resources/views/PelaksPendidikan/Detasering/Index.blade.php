@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Detasering</b>
    <ul>
        @foreach ($data as $detasering)
            <li>
                <a href="{{ route('detasering.detail', ['id' => $detasering['id']]) }}">
                    {{ $loop->iteration }}- {{ $detasering['kategori_kegiatan'] }} -
                    {{ $detasering['perguruan_tinggi'] }} -
                    {{ $detasering['bidang_tugas'] }} -
                    {{ $detasering['sk_penugasan'] }} -
                    {{ $detasering['tanggal_sk_penugasan'] }}
                </a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
