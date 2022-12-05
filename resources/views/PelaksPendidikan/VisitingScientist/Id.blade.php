@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table>
            <tr>
                <td>Perguruan Tinggi</td>
                <td>{{ $data['perguruan_tinggi'] }}</td>
            </tr>
            <tr>
                <td>Lama Kegiatan</td>
                <td>{{ $data['lama_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Tanggal pelaksaan</td>
                <td>{{ $data['tanggal'] }}</td>
            </tr>
            <tr>
                <td>Judul Litabmas</td>
                <td>{{ $data['judul_litabmas'] }}</td>
            </tr>
            <tr>
                <td>Nama Kategori Capaian Luaran</td>
                <td>{{ $data['kategori_capaian_luaran'] }}</td>
            </tr>
            <tr>
                <td>Kegiatan Penting Dilakukan perguruan Tinggi</td>
                <td>{{ $data['kegiatan_penting'] }}</td>
            </tr>
            <tr>
                <td>No. SK Penugasan</td>
                <td>{{ $data['sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Tanggal SK Penugasan</td>
                <td>{{ $data['tanggal_sk_penugasan'] }}</td>
            </tr>
        </table>
    </div>
@endsection
