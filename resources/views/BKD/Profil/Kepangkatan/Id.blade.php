@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table>
        <tr>
            <td>Golongan</td>
            <td>{{ $data['golongan'] }}</td>
        </tr>
        <tr>
            <td>Pangkat</td>
            <td>{{ $data['pangkat'] }}</td>
        </tr>
        <tr>
            <td>No SK</td>
            <td>{{ $data['sk'] }}</td>
        </tr>
        <tr>
            <td>Tanggal SK</td>
            <td>{{ $data['tanggal_sk'] }}</td>
        </tr>
        <tr>
            <td>Terhitung Mulai Tanggal</td>
            <td>{{ $data['tanggal_mulai'] }}</td>
        </tr>
        <tr>
            <td>Masa Kerja Golongan (Tahun)</td>
            <td>{{ $data['masa_kerja_tahun'] }}</td>
        </tr>
        <tr>
            <td>Masa Kerja Golongan (Bulan)</td>
            <td>{{ $data['masa_kerja_bulan'] }}</td>
        </tr>

        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Jenis Dokumen</th>
            <th>Nama File</th>
            <th>Tanggal Upload</th>
        </tr>
        @foreach ($data['dokumen'] as $dokumen)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $dokumen['nama'] }}</td>
            <td>{{ $dokumen['jenis_file'] }}</td>
            <td>{{ $dokumen['nama_file'] }}</td>
            <td>{{ $dokumen['tanggal_upload'] }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection