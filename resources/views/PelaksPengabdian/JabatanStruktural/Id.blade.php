@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
<div class="card p-2">
    <table>
        <tr>
            <td>Jabatan</td>
            <td>{{ $data['jabatan'] }}</td>
        </tr>
        <tr>
            <td>SK Jabatan</td>
            <td>{{ $data['sk_jabatan'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Mulai Jabatan</td>
            <td>{{ $data['tanggal_mulai_jabatan'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Selesai Jabatan</td>
            <td>{{ $data['tanggal_selesai_jabatan'] }}</td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>{{ $data['lokasi'] }}</td>
        </tr>
        <x-dokumen :document="$data['dokumen']"></x-dokumen>
    </table>
</div>
@endsection
