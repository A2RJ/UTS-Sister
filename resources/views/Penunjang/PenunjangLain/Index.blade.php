@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Penunjang Lain</b>
    <ul>
        @foreach ($data as $penunjangLain)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('penunjang-lain.detail', ['id' => $penunjangLain['id']]) }}">
                    {{ $penunjangLain['nama'] }} -
                    {{ $penunjangLain['instansi'] }}
                </a>
                {{ $penunjangLain['sk_penugasan'] }}
                {{ $penunjangLain['tanggal_mulai'] }}
                {{ $penunjangLain['tanggal_selesai'] }}
                {{ $penunjangLain['peran'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
