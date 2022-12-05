@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table class="table table-bordered">
            <tr>
                <td>Kategori Kegiatan</td>
                <td>{{ $data['kategori_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Perguruan Tinggi</td>
                <td>{{ $data['perguruan_tinggi'] }}</td>
            </tr>
            <tr>
                <td>Bidang Tugas</td>
                <td>{{ $data['bidang_tugas'] }}</td>
            </tr>
            <tr>
                <td>SK Penugasan</td>
                <td>{{ $data['sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Tanggal SK Penugasan</td>
                <td>{{ $data['tanggal_sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td>{{ $data['tanggal_mulai'] }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>{{ $data['tanggal_selesai'] }}</td>
            </tr>
            <tr>
                <td>Deskripsi Kegiatan</td>
                <td>{{ $data['deskripsi_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Metode Pelaksanaan</td>
                <td>{{ $data['metode_pelaksanaan'] }}</td>
            </tr>
            <x-dokumen :document="$data['dokumen']"></x-dokumen>
        </table>
    </div>
@endsection
