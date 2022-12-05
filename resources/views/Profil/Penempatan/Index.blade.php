@extends('layout.dashboard')

@section('title', 'Penempatan')

@section('content')
    <div class="card p-2">
        <b>Penempatan</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Status</th>
                    <th>Ikatan Kerja</th>
                    <th>Jenjang Pendidikan</th>
                    <th>Unit</th>
                    <th>Perguruan Tinggi</th>
                    <th>Terhitung Mulai Tanggal</th>
                    <th>Tanggal Keluar</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="9" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $penempatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penempatan['status_kepegawaian'] }}</td>
                            <td>{{ $penempatan['ikatan_kerja'] }}</td>
                            <td>{{ $penempatan['jenjang_pendidikan'] }}</td>
                            <td>{{ $penempatan['unit_kerja'] }}</td>
                            <td>{{ $penempatan['perguruan_tinggi'] }}</td>
                            <td>{{ $penempatan['tanggal_mulai'] }}</td>
                            <td>{{ $penempatan['tanggal_keluar'] }}</td>
                            <td>
                                <a href="{{ route('penempatan.detail', ['id' => $penempatan['id']]) }}">
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
