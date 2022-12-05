@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table>
        <tr>
            <td>Nama Organisasi</td>
            <td>{{ $data['nama_organisasi'] }}</td>
        </tr>
        <tr>
            <td>Peran</td>
            <td>{{ $data['peran'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Mulai Keanggotaan</td>
            <td>{{ $data['tanggal_mulai_keanggotaan'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Selesai Keanggotaan</td>
            <td>{{ $data['tanggal_selesai_keanggotaanq'] }}</td>
        </tr>
        <tr>
            <td>Instansi Profesi</td>
            <td>{{ $data['instansi_profesi'] }}</td>
        </tr>
        <tr>
            <td>Kategori Kegiatan</td>
            <td>{{ $data['kategori_kegiatan'] }}</td>
        </tr>
        <x-dokumen :document="$data['dokumen']"></x-dokumen>
    </table>
</div>
@endsection
