@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container card p-2">
        <table class="table table-bordered">
            <tr>
                <td>Jenis Sertifikasi</td>
                <td>{{ $data['jenis_sertifikasi'] }}</td>
            </tr>
            <tr>
                <td>Bidang Studi</td>
                <td>{{ $data['bidang_studi'] }}</td>
            </tr>
            <tr>
                <td>No. Registrasi Pendidik</td>
                <td>{{ $data['nomor_registrasi'] }}</td>
            </tr>
            <tr>
                <td>No. SK Sertifikasi</td>
                <td>{{ $data['sk_sertifikasi'] }}</td>
            </tr>
            <tr>
                <td>Tahun Sertifikasi</td>
                <td>{{ $data['tahun_sertifikasi'] }}</td>
            </tr>
        </table>
    </div>
@endsection
