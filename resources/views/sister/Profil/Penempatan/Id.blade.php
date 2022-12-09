@extends('layouts.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table>
            <tr>
                <td>Status Kepegawaian</td>
                <td>{{ $data['status_kepegawaian'] }}</td>
            </tr>
            <tr>
                <td>Jenjang Pendidikan</td>
                <td>{{ $data['jenjang_pendidikan'] }}</td>
            </tr>
            <tr>
                <td>Unit</td>
                <td>{{ $data['unit_kerja'] }}</td>
            </tr>
            <tr>
                <td>Perguruan Tinggi</td>
                <td>{{ $data['perguruan_tinggi'] }}</td>
            </tr>
            <tr>
                <td>No Surat Tugas</td>
                <td>{{ $data['surat_tugas'] }}</td>
            </tr>
            <tr>
                <td>Terhitung Mulai Tanggal</td>
                <td>{{ $data['tanggal_mulai'] }}</td>
            </tr>
            <tr>
                <td>Tanggal Surat Keluar</td>
                <td>{{ $data['tanggal_surat_tugas'] }}</td>
            </tr>
            <tr>
                <td>Tanggal Keluar</td>
                <td>{{ $data['tanggal_keluar'] }}</td>
            </tr>
            <tr>
                <td>Keterangan Keluar</td>
                <td>{{ $data['jenis_keluar'] }}</td>
            </tr>
            <tr>
                <td>Ikatan Kerja</td>
                <td>{{ $data['ikatan_kerja'] }}</td>
            </tr>
        </table>
    </div>
@endsection
