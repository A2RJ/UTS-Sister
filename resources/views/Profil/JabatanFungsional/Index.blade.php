@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Jabatan fungsional</b>
        <ul>
            @foreach ($data as $jafung)
                <li>
                    <a href="{{ route('jabatan-fungsional.detail', ['id' => $jafung['id']]) }}">
                        {{ $loop->iteration }}- {{ $jafung['jabatan_fungsional'] }} - {{ $jafung['sk'] }} -
                        {{ $jafung['tanggal_mulai'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
