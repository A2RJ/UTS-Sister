@extends('layouts.dashboard')

@section('title', 'Penelitian')

@section('content')
<div class="card p-2">
    <b>Penelitian</b>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Judul</th>
                <th>Bidang Keilmuan</th>
                <th>Tahun Pelaksanaan</th>
                <th>Lama Kegiatan</th>
                <th>Aksi</th>
            </tr>
            @if (count($data) === 0)
            <tr>
                <td colspan="6" class="text-center">Data not found</td>
            </tr>
            @else
            @foreach ($data as $penelitian)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penelitian['judul'] }}</td>
                <td>
                    <ul>
                        @foreach ($penelitian['bidang_keilmuan'] as $bidang)
                        <li>{{ var_dump($bidang) }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $penelitian['tahun_pelaksanaan'] }}</td>
                <td>{{ $penelitian['lama_kegiatan'] }} Tahun</td>
                <td>
                    <a href="{{ route('penelitian.detail', ['id' => $penelitian['id']]) }}">
                        <button class="btn btn-sm btn-outline-primary">Detail</button>
                    </a>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
    </div>
    @endsection