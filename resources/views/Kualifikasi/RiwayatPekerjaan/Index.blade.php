@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Riwayat Pekerjaan</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Nama Pekerjaan</th>
                    <th>Rincian Pekerjaan</th>
                    <th>Waktu</th>
                    <th>LN/DN?</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($data as $riwayatPekerjaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayatPekerjaan['nama_jabatan'] }}</td>
                        <td>
                            {{ $riwayatPekerjaan['jenis_pekerjaan'] }} -
                            {{ $riwayatPekerjaan['instansi'] }} -
                            {{ $riwayatPekerjaan['bidang_usaha'] }} -
                            {{ $riwayatPekerjaan['divisi'] }}
                        </td>
                        <td>{{ $riwayatPekerjaan['mulai_bekerja'] }}</td>
                        <td>{{ $riwayatPekerjaan['luar_negeri'] ? 'LN' : 'DN' }}</td>
                        <td>
                            <a href="{{ route('riwayat-pekerjaan.detail', ['id' => $riwayatPekerjaan['id']]) }}">
                                <button class="btn btn-sm btn-outline-primary">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
