@extends('layouts.dashboard')

@section('title', 'Anggota Profesi')

@section('content')
<div class="card p-2">
    <b>Anggota Profesi</b>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>No.</td>
                <td>Nama Organisasi</td>
                <td>Peran/Kedudukan</td>
                <td>Mulai Keanggotaan</td>
                <td>Selesai Keanggotaan</td>
                <td>Instansi Profesi</td>
                <td>Aksi</td>
            </tr>
            @if (count($data) === 0)
            <tr>
                <td colspan="7" class="text-center">Data not found</td>
            </tr>
            @else
            @foreach ($data as $anggotaProfesi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $anggotaProfesi['nama_organisasi'] }}</td>
                <td>{{ $anggotaProfesi['peran'] }}</td>
                <td>{{ $jabatanSktruktural['tanggal_mulai_keanggotaan'] }}</td>
                <td>{{ $jabatanSktruktural['tanggal_selesai_keanggotaan'] }}</td>
                <td>{{ $jabatanSktruktural['instansi_profesi'] }}</td>
                <td>
                    <a href="{{ route('anggota-profesi.detail', ['id' => $anggotaProfesi['id']]) }}">
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