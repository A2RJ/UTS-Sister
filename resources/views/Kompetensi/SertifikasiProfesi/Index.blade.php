@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <b>Sertifikasi Profesi</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Jenis Sertifikasi</th>
                    <th>Bidang Studi</th>
                    <th>No. Registrasi Pendidik</th>
                    <th>No. SK</th>
                    <th>Tahun Sertifikasi</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($data['profesi'] as $profesi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $profesi['jenis_sertifikasi'] }}</td>
                        <td>{{ $profesi['bidang_studi'] }}</td>
                        <td>{{ $profesi['nomor_registrasi'] }}</td>
                        <td>{{ $profesi['sk_sertifikasi'] }}</td>
                        <td>{{ $profesi['tahun_sertifikasi'] }}</td>
                        <td>
                            <a href="{{ route('sertifikasi-profesi.detail', ['id' => $profesi['id']]) }}">
                                <button class="btn btn-sm btn-outline-primary">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                @foreach ($data['dosen'] as $dosen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $profesi['jenis_sertifikasi'] }}</td>
                        <td>{{ $profesi['bidang_studi'] }}</td>
                        <td>{{ $profesi['nomor_registrasi'] }}</td>
                        <td>{{ $profesi['sk_sertifikasi'] }}</td>
                        <td>{{ $profesi['tahun_sertifikasi'] }}</td>
                        <td>
                            <a href="{{ route('sertifikasi-profesi.detail', ['id' => $profesi['id']]) }}">
                                <button class="btn btn-sm btn-outline-primary">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
