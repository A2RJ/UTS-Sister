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
                <td>Media Publikasi</td>
                <td>{{ $data['media_publikasi'] }}</td>
            </tr>
            <tr>
                <td>Peran</td>
                <td>{{ $data['peran'] }}</td>
            </tr>
            <tr>
                <td>Nomor SK Penugasan</td>
                <td>{{ $data['sk_penugasan'] }}</td>
            </tr>
            <tr>
                <td>Terhitung Mulai Tanggal</td>
                <td>{{ $data['tanggal_mulai'] }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>{{ $data['tanggal_selesai'] }}</td>
            </tr>
            <tr>
                <td>Status Aktif</td>
                <td>{{ $data['aktif'] ? 'Aktif' : 'Non Aktif' }}</td>
            </tr>
            <x-dokumen :document="$data['dokumen']"></x-dokumen>
        </table>
    </div>
@endsection
