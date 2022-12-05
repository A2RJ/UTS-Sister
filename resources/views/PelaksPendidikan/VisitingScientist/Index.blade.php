@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <b>Visiting scientist</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Perguruan Tinggi Pengundang</th>
                    <th>Lama Kegiatan</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="5" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $visitingScientist)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $visitingScientist['perguruan_tinggi'] }}</td>
                            <td>{{ $visitingScientist['lama_kegiatan'] }}</td>
                            <td>{{ $visitingScientist['tanggal'] }}</td>
                            <td>
                                <a href="{{ route('visiting-scientist.detail', ['id' => $visitingScientist['id']]) }}">
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
