@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table class="table table-bordered">
            <tr>
                <td>Kategori</td>
                <td>{{ $data['kategori_kegiatan'] }}</td>
            </tr>
            <tr>
                <td>Jenjang Studi</td>
                <td>{{ $data['jenjang_pendidikan'] }}</td>
            </tr>
            <tr>
                <td>Gelar Studi</td>
                <td>{{ $data['gelar_akademik'] }}</td>
            </tr>
            <tr>
                <td>Bidang Studi</td>
                <td>{{ $data['bidang_studi'] }}</td>
            </tr>
            <tr>
                <td>Perguruan Tinggi</td>
                <td>{{ $data['nama_perguruan_tinggi'] }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>{{ $data['nama_program_studi'] }}</td>
            </tr>
            <tr>
                <td>Tahun Masuk</td>
                <td>{{ $data['tahun_masuk'] }}</td>
            </tr>
            <tr>
                <td>Tahun Lulus</td>
                <td>{{ $data['tahun_lulus'] }}</td>
            </tr>
            <tr>
                <td>Tanggal Kelulusan</td>
                <td>{{ $data['tanggal_lulus'] }}</td>
            </tr>
            <tr>
                <td>Nomor Induk</td>
                <td>{{ $data['nomor_induk'] }}</td>
            </tr>
            <tr>
                <td>Jumlah Semester Tempuh</td>
                <td>{{ $data['jumlah_semester'] }}</td>
            </tr>
            <tr>
                <td>Jumlah SKS Kelulusan</td>
                <td>{{ $data['jumlah_sks'] }}</td>
            </tr>
            <tr>
                <td>IPK Kelulusan</td>
                <td>{{ $data['ipk'] }}</td>
            </tr>
            <tr>
                <td>Nomor SK Penyetaraan</td>
                <td>{{ $data['sk_penyetaraan'] }}</td>
            </tr>
            <tr>
                <td>Tanggal SK Penyetaraan</td>
                <td>{{ $data['tanggal_sk_penyetaraan'] }}</td>
            </tr>
            <tr>
                <td>Nomor Ijazah</td>
                <td>{{ $data['nomor_ijazah'] }}</td>
            </tr>
            <tr>
                <td>Judul Tesis/Disertasi</td>
                <td>{{ $data['judul_tugas_akhir'] }}</td>
            </tr>
        </table>
    </div>
@endsection
