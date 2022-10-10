@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Jabatan fungsional</b>
        <ul>
            @foreach ($data as $jafung)
                <li>{{ $loop->iteration }}- {{ $jafung['jabatan_fungsional'] }} - {{ $jafung['sk'] }} -
                    {{ $jafung['tanggal_mulai'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
