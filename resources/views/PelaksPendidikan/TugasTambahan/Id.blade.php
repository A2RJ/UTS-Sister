@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table>
        <tr>
            <td>Jenis Tugas</td>
            <td>{{ $data['jenis_tugas'] }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>{{ $data['unit_kerja'] }}</td>
        </tr>
        <tr>
            <td>Perguruan Tinggi</td>
            <td>{{ $data['perguruan_tinggi'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Mulai Tugas</td>
            <td>{{ $data['tanggal_mulai_tugas'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Selesai Tugas</td>
            <td>{{ $data['tanggal_selesai_tugas'] }}</td>
        </tr>
        <tr>
            <td>Jumlah Jam</td>
            <td>{{ $data['jumlah_jam'] }}</td>
        </tr>
        <tr>
            <td>SK Penugasan</td>
            <td>{{ $data['sk_penugasan'] }}</td>
        </tr>
    </table>
</div>
@endsection
