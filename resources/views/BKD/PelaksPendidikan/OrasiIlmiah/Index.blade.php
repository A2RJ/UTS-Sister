@extends('layouts.dashboard')

@section('title', 'Orasi Ilmiah')

@section('content')
    <div class="card p-2">
        <b>Orasi Ilmiah</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Kategori Kegiatan</th>
                    <th>Judul Makalah</th>
                    <th>Nama Temu Ilmiah</th>
                    <th>Penyelenggara</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="7" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $orasiIlmiah)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td></td>
                            <td>{{ $orasiIlmiah['judul_makalah'] }}</td>
                            <td>{{ $orasiIlmiah['nama_pertemuan'] }}</td>
                            <td>{{ $orasiIlmiah['penyelenggara'] }}</td>
                            <td>{{ $orasiIlmiah['tanggal_pelaksanaan'] }}</td>
                            <td>
                                <a href="{{ route('orasi-ilmiah.detail', ['id' => $orasiIlmiah['id']]) }}">
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
