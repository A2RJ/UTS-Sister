@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table>
        <tr>
            <td>Kategori Kegiatan</td>
            <td>{{ $data['kategori_kegiatan'] }}</td>
        </tr>
        <tr>
            <td>Jenis Kegiatan</td>
            <td>{{ $data['jenis_kepanitiaan'] }}</td>
        </tr>
        <tr>
            <td>Nama Kegiatan</td>
            <td>{{ $data['nama'] }}</td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>{{ $data['instansi'] }}</td>
        </tr>
        <tr>
            <td>Tingkat</td>
            <td>{{ $data['tingkat'] }}</td>
        </tr>
        <tr>
            <td>Nomor SK Penugasan</td>
            <td>{{ $data['sk_penugasan'] }}</td>
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
            <th colspan="3">Anggota</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Peran</th>
        </tr>
        @foreach ($data['anggota_dosen'] as $anggota_dosen)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $anggota_dosen['nama'] }}</td>
                <td>{{ $anggota_dosen['peran'] }}</td>
            </tr>
        @endforeach
        <x-dokumen :document="$data['dokumen']"></x-dokumen>
    </table>
</div>
@endsection
