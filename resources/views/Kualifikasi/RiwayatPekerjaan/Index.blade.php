@extends('layout.dashboard')

@section('title', 'Riwayat Pekerjaan')

@section('content')
    <div class="card p-2">
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
                @if (count($data) === 0)
                    <tr>
                        <td colspan="6" class="text-center">Data not found</td>
                    </tr>
                @else
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
                @endif
            </table>
        </div>
    </div>
@endsection
