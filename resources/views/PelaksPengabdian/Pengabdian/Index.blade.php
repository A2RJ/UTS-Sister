@extends('layouts.dashboard')

@section('title', 'Pengabdian')

@section('content')
    <div class="card p-2">
        <b>Pengabdian</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No.</td>
                    <td>Judul</td>
                    <td>Bidang Keilmuan</td>
                    <td>Tahun Pelaksanaan</td>
                    <td>Lama Kegiatan</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="6" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $pengabdian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pengabdian['judul'] }}</td>
                            <td>
                                <ul>
                                    @foreach ($pengabdian['bidang_keilmuan'] as $bidang)
                                        <li>{{ $bidang }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $pengabdian['tahun_pelaksanaan'] }}</td>
                            <td>{{ $pengabdian['lama_kegiatan'] }} Tahun</td>
                            <td>
                                <a href="{{ route('pengabdian.detail', ['id' => $pengabdian['id']]) }}">
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
