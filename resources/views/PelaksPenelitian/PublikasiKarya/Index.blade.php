@extends('layout.dashboard')

@section('title', 'Publikasi Karya')

@section('content')
    <div class="card p-2">
        <b>Publikasi Karya</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>No.</td>
                    <td>Judul</td>
                    <td>Kategori Kegiatan</td>
                    <td>Jenis Publikasi</td>
                    <td>Quartile</td>
                    <td>Tanggal Terbit</td>
                    <td>Asal Data</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="8" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $publikasiKarya)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $publikasiKarya['judul'] }}</td>
                            <td>{{ $publikasiKarya['kategori_kegiatan'] }}</td>
                            <td>{{ $publikasiKarya['jenis_publikasi'] }}</td>
                            <td>{{ $publikasiKarya['quartile'] }}</td>
                            <td>{{ $publikasiKarya['tanggal'] }}</td>
                            <td>{{ $publikasiKarya['asal_data'] }}</td>
                            <td>
                                <a href="{{ route('publikasi-karya.detail', ['id' => $publikasiKarya['id']]) }}">
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
