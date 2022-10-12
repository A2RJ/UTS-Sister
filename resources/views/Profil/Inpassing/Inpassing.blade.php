@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Inpassing</b>
        <ul>
            @foreach ($data as $inpassing)
                <li>
                    <a href="{{ route('inpassing.detail', ['id' => $inpassing['id']]) }}">
                        {{ $loop->iteration }}- {{ $inpassing['pangkat_golongan'] }} - {{ $inpassing['sk'] }} -
                        {{ $inpassing['tanggal_sk'] }} - {{ $inpassing['tanggal_mulai'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
