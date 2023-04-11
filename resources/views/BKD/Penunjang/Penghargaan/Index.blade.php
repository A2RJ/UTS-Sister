@extends('layouts.dashboard')

@section('title', 'Penghargaan')

@section('content')
<div class="card p-2">
    <b>Penghargaan</b>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>No.</td>
                <td>Penghargaan</td>
                <td>Jenis Penghargaan</td>
                <td>Instansi</td>
                <td>Tahun</td>
                <td>Aksi</td>
            </tr>
            @if (count($data) === 0)
            <tr>
                <td colspan="6" class="text-center">Data not found</td>
            </tr>
            @else
            @foreach ($data as $penghargaan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penghargaan['nama'] }}</td>
                <td>{{ $penghargaan['jenis_penghargaan'] }}</td>
                <td>{{ $jabatanSktruktural['instansi_pemberi'] }}</td>
                <td>{{ $jabatanSktruktural['tahun'] }}</td>
                <td>
                    <a href="{{ route('penghargaan.detail', ['id' => $penghargaan['id']]) }}">
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