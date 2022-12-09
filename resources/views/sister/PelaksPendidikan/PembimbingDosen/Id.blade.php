@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table class="table table-bordered">
            <tr>
                <td>Nama Pembimbing</td>
                <td>{{ $data['nama_pembimbing'] }}</td>
            </tr>
            <tr>
                <td>Nama Bimbingan</td>
                <td>{{ $data['nama_bimbingan'] }}</td>
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
                <td>Jabatan Fungsional Pembimbing</td>
                <td>{{ $data['jabatan_fungsional_pembimbing'] }}</td>
            </tr>
            <tr>
                <td>Jabatan Fungsional Bimbingan</td>
                <td>{{ $data['jabatan_fungsional_bimbingan'] }}</td>
            </tr>
            <tr>
                <td>Bidang Keahlian Pembimbing</td>
                <td>{{ $data['bidang_keahlian_pembimbing'] }}</td>
            </tr>
            <tr>
                <td>Deskripsi Kegiatan</td>
                <td>{{ $data['bidang_keahlian_bimbingan'] }}</td>
            </tr>
            <tr>
                <td>Jenis Bimbingan</td>
                <td>{{ $data['jenis_bimbingan'] }}</td>
            </tr>
            <tr>
                <td>SK Penugasan</td>
                <td>{{ $data['sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Tanggal SK Penugasan</td>
                <td>{{ $data['tanggal_sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>{{ $data['unit_kerja'] }}</td>
            </tr>
        </table>
    </div>
@endsection
