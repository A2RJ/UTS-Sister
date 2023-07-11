@extends('layouts.dashboard')

@section('title', 'Kepangkatan')

@section('content')
<div class="card p-2">
    <b>Kepangkatan</b>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Golongan/Pangkat</th>
                <th>Nomor SK</th>
                <th>Terhitung Mulai Tanggal</th>
                <th>Aksi</th>
            </tr>
            @if (count($data) === 0)
            <tr>
                <td colspan="5" class="text-center">Data not found</td>
            </tr>
            @else
            @foreach ($data as $kepangkatan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kepangkatan['pangkat_golongan'] }}</td>
                <td>{{ $kepangkatan['sk'] }}</td>
                <td>{{ $kepangkatan['tanggal_mulai'] }}</td>
                <td>
                    <a href="{{ route('kepangkatan.detail', ['id' => $kepangkatan['id']]) }}">
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