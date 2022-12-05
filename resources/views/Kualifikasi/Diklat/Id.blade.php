@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table class="table table-bordered">
        <tr>
            <td>Jenis Diklat</td>
            <td>{{ $data['jenis_diklat'] }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $data['nama'] }}</td>
        </tr>
        <tr>
            <td>Penyelenggara</td>
            <td>{{ $data['penyelenggara'] }}</td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>{{ $data['tahun'] }}</td>
        </tr>
        <tr>
            <td>Jumlah Jam</td>
            <td>{{ $data['jumlah_jam'] }}</td>
        </tr>
        <tr>
            <td>Nomr Sertifikat </td>
            <td>{{ $data['no_sertifikat'] }}</td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>{{ $data['lokasi'] }}</td>
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
            <td>SK Penugasan</td>
            <td>{{ $data['sk_penugasan'] }}</td>
        </tr>
        <tr>
            <td>Tanggal SK Penugasan</td>
            <td>{{ $data['tanggal_sk_penugasan'] }}</td>
        </tr>
        <x-dokumen :document="$data['dokumen']"></x-dokumen>
    </table>
</div>
@endsection
