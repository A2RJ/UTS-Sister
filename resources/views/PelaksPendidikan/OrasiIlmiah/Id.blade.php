@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <table>
        <tr>
            <td>Judul Makalah</td>
            <td>{{ $data['judul_makalah'] }}</td>
        </tr>
        <tr>
            <td>Nama Pertemuan</td>
            <td>{{ $data['nama_pertemuan'] }}</td>
        </tr>
        <tr>
            <td>Penyelenggara</td>
            <td>{{ $data['penyelenggara'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Pelaksanaan</td>
            <td>{{ $data['tanggal_pelaksanaan'] }}</td>
        </tr>
        <tr>
            <td>Kategori Pembicara</td>
            <td>{{ $data['kategori_pembicara'] }}</td>
        </tr>
        <tr>
            <td>Kategori Kegiatan</td>
            <td>{{ $data['kategori_kegiatan'] }}</td>
        </tr>
        <tr>
            <td>Bahasa Pertemuan</td>
            <td>{{ $data['bahasa'] }}</td>
        </tr>
        <tr>
            <td>SK Penugasan</td>
            <td>{{ $data['sk'] }}</td>
        </tr>
        <tr>
            <td>Tanggal SK Penugasan</td>
            <td>{{ $data['tanggal_sk_penugasan'] }}</td>
        </tr>
        <tr>
            <td>Judul Litabmas</td>
        </tr>
        <tr>
            <td>Kategori Capaian Luaran</td>
            <td>{{ $data['categori_capaian_luaran'] }}</td>
        </tr>
    </table>
@endsection
