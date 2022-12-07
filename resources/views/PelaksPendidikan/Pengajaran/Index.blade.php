@extends('layouts.dashboard')

@section('title', 'Pengajaran')

@section('content')
    <div class="card p-3">
        <b>Pengajaran</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Mata Kuliah</th>
                    <th>Jenis Mata Kuliah</th>
                    <th>Bidang Keilmuan</th>
                    <th>Kelas</th>
                    <th>Jumlah Mahasiswa</th>
                    <th>SKS</th>
                    <th>Rubrik BKD</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="9" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $pengajaran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengajaran['mata_kuliah'] }}</td>
                            <td><b>Tidak ada di API</b></td>
                            <td><b>Tidak ada di API</b></td>
                            <td>{{ $pengajaran['kelas'] }}</td>
                            <td>{{ $pengajaran['jumlah_mahasiswa'] }}</td>
                            <td>{{ $pengajaran['sks'] }}</td>
                            <td><b>Tidak ada di API</b></td>
                            <td>
                                <a href="{{ route('pengajaran.detail', ['id' => $pengajaran['id']]) }}">
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
