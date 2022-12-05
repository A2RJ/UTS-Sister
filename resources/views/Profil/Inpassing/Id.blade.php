@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table>
            <tr>
                <td>Pangkat/Golongan</td>
                <td>{{ $data['pangkat'] }}</td>
            </tr>
            <tr>
                <td>Nomor SK Inpassing</td>
                <td>{{ $data['sk'] }}</td>
            </tr>
            <tr>
                <td>Tanggal SK</td>
                <td>{{ $data['tanggal_sk'] }}</td>
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
                <td>Masa Kerja (Tahun)</td>
                <td>{{ $data['masa_kerja_tahun'] }}</td>
            </tr>
            <tr>
                <td>Masa Kerja (Bulan)</td>
                <td>{{ $data['masa_kerja_bulan'] }}</td>
            </tr>
        </table>

        <div>
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
                        <td>{{ $dokumen['id'] }}</td>
                        <td>{{ $dokumen['nama'] }}</td>
                        <td>{{ $dokumen['nama_file'] }}</td>
                        <td>{{ $dokumen['jenis_file'] }}</td>
                        <td>{{ $dokumen['tanggal_upload'] }}</td>
                        <td>{{ $dokumen['jenis_dokumen'] }}</td>
                        <td>
                            <a href="{{ route('inpassing.download', ['id' => $dokumen['id']]) }}">Download</a>
                            <a href="">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
