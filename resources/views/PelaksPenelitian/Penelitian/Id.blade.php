@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table>
            <tr>
                <td>Skim Kegiatan</td>
                <td>{{ $data['jenis_skim'] }}</td>
            </tr>
            <tr>
                <td>Tahun Anggaran</td>
                <td>{{ $data['tahun_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Litabmas Sebelumnya</td>
                <td>{{ $data['litabmas_sebelumnya'] }}</td>
            </tr>
            <tr>
                <td>Afiliasi</td>
                <td>{{ $data['afiliasi'] }}</td>
            </tr>
            <td>Kelompok Bidang</td>
            <td>{{ $data['kelompok_bidang'] }}</td>
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
                <td>Lama Kegiatan (Tahun)</td>
                <td>{{ $data['lama_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Judul Kegiatan</td>
                <td>{{ $data['judul'] }}</td>
            </tr>
            <tr>
                <td>Lokasi Kegiatan</td>
                <td>{{ $data['lokasi'] }}</td>
            </tr>
            <tr>
                <td>Tahun Pelaksanaan Ke</td>
                <td>{{ $data['tahun_pelaksanaan_ke'] }}</td>
            </tr>
            <tr>
                <td>Dana dari Dikti (Rp.)</td>
                <td>{{ $data['dana_dikti'] }}</td>
            </tr>
            <tr>
                <td>Dana dari Perguruan Tinggi (Rp.)</td>
                <td>{{ $data['dana_perguruan_tinggi'] }}</td>
            </tr>
            <tr>
                <td>Dana dari Institusi Lain (Rp.)</td>
                <td>{{ $data['dana_institusi_lain'] }}</td>
            </tr>
            <tr>
                <td>In Kind</td>
                <td>{{ $data['in_kind'] }}</td>
            </tr>
            <tr>
                <th colspan="4">Anggota Dosen/Mahasiswa/Non Civitas Akademika</th>
            </tr>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Peran</th>
                <th>Aktif</th>
            </tr>
            @foreach ($data['anggota'] as $anggota)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $anggota['nama'] }}</td>
                    <td>{{ $anggota['peran'] }}</td>
                    <td>{{ $anggota['stat_aktif'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
