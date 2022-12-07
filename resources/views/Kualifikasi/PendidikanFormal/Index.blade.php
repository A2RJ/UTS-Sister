@extends('layouts.dashboard')

@section('title', 'Pendidikan Formal')

@section('content')
    <div class="card p-2">
        <b>Pendidikan Formal</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Jenjang</th>
                    <th>Gelar</th>
                    <th>Bidang Studi</th>
                    <th>Perguruan Tinggi</th>
                    <th>Tahun Lulus</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="7" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $pendidikanFormal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pendidikanFormal['jenjang_pendidikan'] }}</td>
                            <td>{{ $pendidikanFormal['gelar_akademik'] }}</td>
                            <td>{{ $pendidikanFormal['bidang_studi'] }}</td>
                            <td>{{ $pendidikanFormal['nama_perguruan_tinggi'] }}</td>
                            <td>{{ $pendidikanFormal['tahun_lulus'] }}</td>
                            <td>
                                <a href="{{ route('pendidikan-formal.detail', ['id' => $pendidikanFormal['id']]) }}">
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
