@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Inpassing</b>
        <ul>
            @foreach ($data as $inpassing)
                <li>{{ $loop->iteration }}- {{ $inpassing['pangkat_golongan'] }} - {{ $inpassing['sk'] }} -
                    {{ $inpassing['tanggal_sk'] }} - {{ $inpassing['tanggal_mulai'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
