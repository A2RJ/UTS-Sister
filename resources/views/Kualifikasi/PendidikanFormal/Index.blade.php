@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card">
        <b>Pendidikan Formal</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Jenjang</th>
                    <th>Gelar</th>
                    <th>Bidang Studi</th>
                    <th>Perguruan Tinggi</th>
                    <th>Tahun Lulus</th>
                    <th>Aksi</th>
                </tr>
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
            </table>
        </div>
    </div>
@endsection
