@extends('layouts.dashboard')

@section('title', 'Penunjang Lain')

@section('content')
    <div class="card p-2">
        <b>Penunjang Lain</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No.</td>
                    <td>Nama Kegiatan</td>
                    <td>Instansi Penyelenggara</td>
                    <td>Nomor SK Penugasan</td>
                    <td>Terhuitung Mulai Tanggal</td>
                    <td>Tanggal Selesai</td>
                    <td>Peran</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="8" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $penunjangLain)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penunjangLain['nama'] }}</td>
                            <td>{{ $penunjangLain['instansi'] }}</td>
                            <td>{{ $penunjangLain['sk_penugasan'] }}</td>
                            <td>{{ $penunjangLain['tanggal_mulai'] }}</td>
                            <td>{{ $penunjangLain['tanggal_selesai'] }}</td>
                            <td>{{ $penunjangLain['peran'] }}</td>
                            <td>
                                <a href="{{ route('penunjang-lain.detail', ['id' => $penunjangLain['id']]) }}">
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
