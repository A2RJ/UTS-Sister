@extends('layouts.dashboard')

@section('title', 'Tugas Tambahan')

@section('content')
<div class="card p-2">
    <b>Tugas Tambahan</b>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>No.</td>
                <td>Tugas Tambahan</td>
                <td>Unit Kerja</td>
                <td>Instansi</td>
                <td>Tanggal Mulai</td>
                <td>Tanggal Berakhir</td>
                <td>Aksi</td>
            </tr>
            @if (count($data) === 0)
            <tr>
                <td colspan="7" class="text-center">Data not found</td>
            </tr>
            @else
            @foreach ($data as $tugasTambahan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tugasTambahan['jenis_tugas'] }}</td>
                <td>{{ $tugasTambahan['unit_kerja'] }}</td>
                <td>{{ $tugasTambahan['perguruan_tinggi'] }}</td>
                <td>{{ $tugasTambahan['tanggal_mulai_tugas'] }}</td>
                <td>{{ $tugasTambahan['tanggal_selesai_tugas'] }}</td>
                <td>
                    <a href="{{ route('tugas-tambahan.detail', ['id' => $tugasTambahan['id']]) }}">
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