@extends('layout.dashboard')

@section('title', 'Bimbingan Dosen')

@section('content')
    <div class="card p-2">
        <b>Bimbingan Dosen</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>No.</td>
                    <td>Nama Pembimbing</td>
                    <td>Nama Bimbingan</td>
                    <td>Tanggal Mulai</td>
                    <td>Tanggal Selesai</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="6" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $bimbinganDosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bimbinganDosen['nama_pembimbing'] }}</td>
                            <td>{{ $bimbinganDosen['nama_bimbing'] }}</td>
                            <td>{{ $bimbinganDosen['tanggal_mulai'] }}</td>
                            <td>{{ $bimbinganDosen['tanggal_selesai'] }}</td>
                            <td>
                                <a href="{{ route('pembimbing-dosen.detail', ['id' => $bimbinganDosen['id']]) }}">
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
