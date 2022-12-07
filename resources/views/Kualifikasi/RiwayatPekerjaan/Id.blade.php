@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table class="table table-bordered">
            <tr>
                <td>Jenis Pekerjaan</td>
                <td>{{ $data['jenis_pekerajaan'] }}</td>
            </tr>
            <tr>
                <td>Nama Jabatan</td>
                <td>{{ $data['nama_jabatan'] }}</td>
            </tr>
            <tr>
                <td>Instansi</td>
                <td>{{ $data['instansi'] }}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>{{ $data['divisi'] }}</td>
            </tr>
            <tr>
                <td>Mulai Bekerja</td>
                <td>{{ $data['mulai_bekerja'] }}</td>
            </tr>
            <tr>
                <td>Selesai Bekerja</td>
                <td>{{ $data['selesai_bekerja'] }}</td>
            </tr>
            <tr>
                <td>Luar Negeri</td>
                <td>{{ $data['luar_negeri'] }}</td>
            </tr>
            <tr>
                <td>Bidang Usaha</td>
                <td>{{ $data['bidang_usaha'] }}</td>
            </tr>
            <tr>
                <td>Deskripsi Kerja</td>
                <td>{{ $data['deskripsi_kerja'] }}</td>
            </tr>
            <x-dokumen :document="$data['dokumen']"></x-dokumen>
        </table>
    </div>
@endsection
