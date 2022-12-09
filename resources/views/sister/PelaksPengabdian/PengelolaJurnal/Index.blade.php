@extends('layouts.dashboard')

@section('title', 'Publikasi Jurnal')

@section('content')
    <div class="card p-2">
        <b>Publikasi Jurnal</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No.</td>
                    <td>Nama Jurnal</td>
                    <td>No. SK Penugasan</td>
                    <td>Terhitung Mulai Tanggal</td>
                    <td>Tanggal Selesai</td>
                    <td>Status Aktif</td>
                    <td>Peran</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="8" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $publikasiJurnal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $publikasiJurnal['media_publikasi'] }}</td>
                            <td>{{ $publikasiJurnal['sk_penugasan'] }}</td>
                            <td>{{ $publikasiJurnal['tanggal_mulai'] }}</td>
                            <td>{{ $publikasiJurnal['tanggal_selesai'] }}</td>
                            <td>{{ $publikasiJurnal['aktif'] }}</td>
                            <td>{{ $publikasiJurnal['peran'] }}</td>
                            <td>
                                <a href="{{ route('penglola-jurnal.detail', ['id' => $publikasiJurnal['id']]) }}">
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
