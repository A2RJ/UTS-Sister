@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table>
        <tr>
            <td>Judul Karya/Kegiatan</td>
            <td>{{ $data['judul'] }}</td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td>{{ $data['jenis_publikasi'] }}</td>
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
            <td>Tanggal</td>
            <td>{{ $data['tanggal'] }}</td>
        </tr>
        <tr>
            <td>Penyelenggara</td>
            <td>{{ $data['penerbit'] }}</td>
        </tr>
        <tr>
            <td>Tautan Eksternal</td>
            <td>{{ $data['tautan'] }}</td>
        </tr>
        <tr>
            <td>Keterangan/Petunjuk Akses</td>
            <td>{{ $data['keterangan'] }}</td>
        </tr>
        <tr>
            <th colspan="5">Penulis Dosen/Mahasiswa/Lain</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Urutan</th>
            <th>Afiliasi</th>
            <th>Peran</th>
            <th>Corresponding Author</th>
        </tr>
        @foreach ($data['penulis'] as $penulis)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penulis['nama'] }}</td>
                <td>{{ $penulis['urutan'] }}</td>
                <td>{{ $penulis['afiliasi'] }}</td>
                <td>{{ $penulis['peran'] }}</td>
                <td>{{ $penulis['corresponding_author'] }}</td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
