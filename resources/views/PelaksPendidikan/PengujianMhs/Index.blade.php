@extends('layouts.dashboard')

@section('title', 'Pengujian Mahasiswa')

@section('content')
    <div class="card p-2">
        <b>Pengujian Mahasiswa</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Judul Pengujian</th>
                    <th>Bidang Keilmuan</th>
                    <th>Jenis Pengujian</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="6" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $pengujianMahasiswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengujianMahasiswa['judul'] }} ({{ $pengujianMahasiswa['semester'] }})</td>
                            <td>{{ $pengujianMahasiswa['id_katgiat'] }}</td>
                            <td>{{ $pengujianMahasiswa['jenis_pengujian'] }}</td>
                            <td>{{ $pengujianMahasiswa['program_studi'] }}</td>
                            <td>
                                <a href="{{ route('pengujian-mahasiswa.detail', ['id' => $pengujianMahasiswa['id']]) }}">
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
