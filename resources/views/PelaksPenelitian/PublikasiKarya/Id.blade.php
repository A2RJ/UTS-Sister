@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table>
        <tr>
            <td>Judul Artikel</td>
            <td>{{ $data['judul_artikel'] }}</td>
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
            <td>Nama Jurnal</td>
            <td>{{ $data['nama_jurnal'] }}</td>
        </tr>
        <tr>
            <td>Tautan Laman Jurnal</td>
            <td>{{ $data['tautan'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Terbit</td>
            <td>{{ $data['tanggal'] }}</td>
        </tr>
        <tr>
            <td>Volume</td>
            <td>{{ $data['volume'] }}</td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td>{{ $data['nomor'] }}</td>
        </tr>
        <tr>
            <td>Halaman</td>
            <td>{{ $data['halaman'] }}</td>
        </tr>
        <tr>
            <td>Penerbit/Penyelenggara</td>
            <td>{{ $data['penerbit'] }}</td>
        </tr>
        <tr>
            <td>DOI</td>
            <td>{{ $data['doi'] }}</td>
        </tr>
        <tr>
            <td>ISSN</td>
            <td>{{ $data['issn'] }} - {{ $data['isbn'] }}</td>
        </tr>
        <tr>
            <td>Tautan Eksternal</td>
            <td>{{ $data['tautan'] }}</td>
        </tr>
        <tr>
            <td>Katerangan/Petunjuk Akses</td>
            <td>{{ $data['keterangan'] }}</td>
        </tr>
        <tr>
            <th colspan="5">Anggota Dosen/Mahasiswa/Non Civitas Akademika</th>
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
