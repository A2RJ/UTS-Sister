@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Penunjang Lain</b>
    <ul>
        @foreach ($data as $penunjangLain)
            <li>{{ $loop->iteration }} -
                {{ $penunjangLain['nama'] }} -
                {{ $penunjangLain['instansi'] }}
                {{ $penunjangLain['sk_penugasan'] }}
                {{ $penunjangLain['tanggal_mulai'] }}
                {{ $penunjangLain['tanggal_selesai'] }}
                {{ $penunjangLain['peran'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
