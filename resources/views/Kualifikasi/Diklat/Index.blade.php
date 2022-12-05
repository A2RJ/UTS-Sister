@extends('layout.dashboard')

@section('title', 'Diklat')

@section('content')
    <div class="card p-2">
        <b>Diklat</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Nama Diklat</th>
                    <th>Jenis Diklat</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="7" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $diklat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $diklat['nama'] }}</td>
                            <td>{{ $diklat['jenis_diklat'] }}</td>
                            <td>{{ $diklat['penyelenggara'] }}</td>
                            <td>{{ $diklat['tahun_lulus'] }}</td>
                            <td>{{ $diklat['status'] }}</td>
                            <td>
                                <a href="{{ route('diklat.detail', ['id' => $diklat['id']]) }}">
                                    <button class="btn btn-sm btn-outline-sm">Detail</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection
