@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <b>Jabatan Struktural</b>
    <ul>
        @foreach ($data as $jabatanStruktural)
            <li>{{ $loop->iteration }} -
                <a href="{{ route('jabatan-struktural.detail', ['id' => $jabatanStruktural['id']]) }}"></a>
                {{ $jabatanStruktural['tanggal_mulai_jabatan'] }}
                {{ $jabatanStruktural['tanggal_selesai_jabatan'] }}
            </li>
        @endforeach
    </ul>
    </div>
@endsection
