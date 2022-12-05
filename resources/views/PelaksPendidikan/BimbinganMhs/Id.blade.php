@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table class="table table-bordered">
            <tr>
                <td>Judul Aktivitas Pemimbing</td>
                <td>{{ $data['judul'] }}</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>{{ $data['lokasi'] }}</td>
            </tr>
            <tr>
                <td>Nomor SK Penugasan</td>
                <td>{{ $data['sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Tanggal SK Penugasan</td>
                <td>{{ $data['tanggal_sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Keterangan Aktivitas</td>
                <td>{{ $data['keterangan'] }}</td>
            </tr>
            <tr>
                <td>Apakah Komunal ?</td>
                <td>{{ $data['komunal'] }}</td>
            </tr>
            <tr>
                <td>Jenis Bimbingan</td>
                <td>{{ $data['jenis_bimbingan'] }}</td>
            </tr>
            <tr>
                <td>Program Studi Mahasiswa</td>
                <td>{{ $data['program_studi'] }}</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>{{ $data['semester'] }}</td>
            </tr>
            <tr>
                <th>No.</th>
                <th>Nama Dosen</th>
                <th>Kategori Kegiatan</th>
                <th>Urutan Pemotor</th>
            </tr>
            @foreach ($data['dosen'] as $dosen)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dosen['nama'] }}</td>
                    <td>{{ $dosen['kategori_kegiatan'] }}</td>
                    <td>{{ $dosen['urutan'] }}</td>
                </tr>
            @endforeach
            <tr>
                <th>No.</th>
                <th>Nama Mahasiswa</th>
                <th>Peran</th>
            </tr>
            @foreach ($data['mahasiswa'] as $mahasiswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mahasiswa['nama'] }} - NIPD: {{ $mahasiswa['nomor_induk'] }}</td>
                    <td>{{ $mahasiswa['peran'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
