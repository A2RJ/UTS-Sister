@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table>
            <tr>
                <td>Jabatan Fungsional</td>
                <td>{{ $data['jabatan_fungsional'] }}</td>
            </tr>
            <tr>
                <td>Nomor SK</td>
                <td>{{ $data['sk'] }}</td>
            </tr>
            <tr>
                <td>Terhitung Mulai Tanggal</td>
                <td>{{ $data['tanggal_mulai'] }}</td>
            </tr>
            <tr>
                <td>Angka Kredit</td>
                <td>{{ $data['angka_kredit'] }}</td>
            </tr>
            <tr>
                <td>Kelebihan Pengajaran</td>
                <td>{{ $data['kelebihan_pengajaran'] }}</td>
            </tr>
            <tr>
                <td>Kelebihan Penelitian</td>
                <td>{{ $data['kelebihan_penelitian'] }}</td>
            </tr>
            <tr>
                <td>Kelebihan Pengabdian</td>
                <td>{{ $data['kelebihan_pengabdian'] }}</td>
            </tr>
            <tr>
                <td>Kelebihan Penunjang</td>
                <td>{{ $data['kelebihan_penunjang'] }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <th>No.</th>
                <th>Nama Dokumen</th>
                <th>Nama File</th>
                <th>Jenis File</th>
                <th>Tanggal Upload</th>
                <th>Jenis Dokumen</th>
                <th>Aksi</th>
            </tr>
            @foreach ($data['dokumen'] as $dokumen)
                <tr>
                    <td>{{ $dokumen['nama'] }}</td>
                    <td>{{ $dokumen['nama_file'] }}</td>
                    <td>{{ $dokumen['jenis_file'] }}</td>
                    <td>{{ $dokumen['tanggal_upload'] }}</td>
                    <td>{{ $dokumen['jenis_dokumen'] }}</td>
                    <td>
                        <a href="">
                            Download
                        </a>
                        <a href="">
                            Detail
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
