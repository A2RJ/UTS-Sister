@extends('layout.dashboard')

@section('title', 'Paten HKI')

@section('content')
    <div class="card p-2">
        <b>Paten HKI</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No.</td>
                    <td>Judul</td>
                    <td>Kategori Kegiatan</td>
                    <td>Jenis</td>
                    <td>Quartile</td>
                    <td>Tanggal Terbit</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="7" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $paten)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $paten['judul'] }}</td>
                            <td>{{ $paten['kategori_kegiatan'] }}</td>
                            <td>{{ $paten['jenis_publikasi'] }}</td>
                            <td>{{ $paten['quartile'] }}</td>
                            <td>{{ $paten['tanggal'] }}</td>
                            <td>
                                <a href="{{ route('paten-hki.detail', ['id' => $paten['id']]) }}">
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
