@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table>
            <tr>
                <td>Jenis Penghargaan</td>
                <td>{{ $data['jenis_penghargaan'] }}</td>
            </tr>
            <tr>
                <td>Nama Penghargaan</td>
                <td>{{ $data['nama_penghargaan'] }}</td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>{{ $data['tahun'] }}</td>
            </tr>
            <tr>
                <td>Instansi Pemberi</td>
                <td>{{ $data['instansi_pemberi'] }}</td>
            </tr>
            <tr>
                <td>Nama Kategori Kegiatan</td>
                <td>{{ $data['kategori_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Tingkat Penghargaan</td>
                <td>{{ $data['tingkat_penghargaan'] }}</td>
            </tr>
            <x-dokumen :document="$data['dokumen']"></x-dokumen>
        </table>
    </div>
@endsection
