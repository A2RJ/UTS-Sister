@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <b>Nilai tes</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Nama Tes</th>
                    <th>Skor Tes</th>
                    <th>Jenis Tes</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($data as $sertifikasiProfesi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sertifikasiProfesi['nama'] }}</td>
                        <td>{{ $sertifikasiProfesi['skor'] }}</td>
                        <td>{{ $sertifikasiProfesi['jenis_tes'] }}</td>
                        <td>{{ $sertifikasiProfesi['penyelenggara'] }}</td>
                        <td>{{ $sertifikasiProfesi['tahun'] }}</td>
                        <td>
                            <a href="{{ route('tes.detail', ['id' => $sertifikasiProfesi['id']]) }}">
                                <button class="btn btn-sm btn-outline-primary">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
