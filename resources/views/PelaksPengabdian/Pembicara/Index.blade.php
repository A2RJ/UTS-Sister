@extends('layouts.dashboard')

@section('title', 'Pembicara')

@section('content')
    <div class="card p-2">
        <b>Pembicara</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No.</td>
                    <td>Kategori Kegiatan</td>
                    <td>Judul Makalah</td>
                    <td>Nama Temu Ilmuah</td>
                    <td>Penyelenggara</td>
                    <td>Tanggal Pelaksanaan</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="7" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $pembicara)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pembicara['kategori_kegiatan'] }}</td>
                            <td>{{ $pembicara['judul_makalah'] }}</td>
                            <td>{{ $pembicara['nama_pertemuan'] }}</td>
                            <td>{{ $pembicara['penyelenggara'] }}</td>
                            <td>{{ $pembicara['tanggal_pelaksanaan'] }}</td>
                            <td>
                                <a href="{{ route('pembicara.detail', ['id' => $pembicara['id']]) }}">
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
