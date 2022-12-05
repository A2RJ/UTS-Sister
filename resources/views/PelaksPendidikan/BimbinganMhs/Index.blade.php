@extends('layout.dashboard')

@section('title', 'Bimbingan Mahasiswa')

@section('content')
    <div class="card p-2">
        <b>Bimbingan Mahasiswa</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No.</td>
                    <td>Semester</td>
                    <td>Kategori Kagiatan</td>
                    <td>Judul Bimbingan</td>
                    <td>Bidang Keilmuan</td>
                    <td>Jenis Bimbingan</td>
                    <td>Program Studi</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="8" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $bimbinganMahasiswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bimbinganMahasiswa['semester'] }}</td>
                            <td>{{ $bimbinganMahasiswa['nm_kat'] }}</td>
                            <td>{{ $bimbinganMahasiswa['judul'] }}</td>
                            <td>{{ $bimbinganMahasiswa['id_katgiat'] }}</td>
                            <td>{{ $bimbinganMahasiswa['jenis_bimbingan'] }}</td>
                            <td>{{ $bimbinganMahasiswa['program_studi'] }}</td>
                            <td>
                                <a href="{{ route('bimbingan-mahasiswa.detail', ['id' => $bimbinganMahasiswa['id']]) }}">
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
