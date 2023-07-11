@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table class="table table-bordered">
        <tr style="color: red">
            <td>NOTE</td>
            <td>Bedakan table by jenis:
                Allowed: Dosen┃Mahasiswa┃Profesional/Mitra
                Jenis penulis</td>
        </tr>
        <tr>
            <td>Jenis Bahan Ajar</td>
            <td>{{ $data['nama_jenis'] }}</td>
        </tr>
        <tr>
            <td>Kategori Capaian</td>
            <td>{{ $data['kategori_capaian_luaran'] }}</td>
        </tr>
        <tr>
            <td>Aktivitas Litabmas</td>
            <td>{{ $data['judul_litabmas'] }}</td>
        </tr>
        <tr>
            <td>Judul Bahan Ajar</td>
            <td>{{ $data['judul'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Terbit</td>
            <td>{{ $data['tanggal_terbit'] }}</td>
        </tr>
        <tr>
            <td>Penerbit</td>
            <td>{{ $data['nama_penerbit'] }}</td>
        </tr>
        <tr>
            <td>ISBN</td>
            <td>{{ $data['isbn'] }}</td>
        </tr>
        <tr>
            <td>SK Penugasan/Bukti</td>
            <td>{{ $data['sk_penugasan'] }}</td>
        </tr>
        <tr>
            <td>Tanggal SK Penugasan/Bukti</td>
            <td>{{ $data['tanggal_sk_penugasan'] }}</td>
        </tr>
        <tr>
            <th>No.</th>
            <th>Nama Dosen</th>
            <th>Urutan</th>
            <th>Afiliasi</th>
            <th>Peran</th>
        </tr>
        @foreach ($data['penulis'] as $penulis)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $penulis['nama'] }} NIPD: {{ $penulis['nomor_induk_peserta_didik'] }}</td>
            <td>{{ $penulis['urutan'] }}</td>
            <td>{{ $penulis['afiliasi'] }}</td>
            <td>{{ $penulis['peran'] }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection