@extends('layouts.dashboard')

@section('title', 'Tes')

@section('content')
    <div class="card p-2">
        <b>Nilai tes</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Nama Tes</th>
                    <th>Skor Tes</th>
                    <th>Jenis Tes</th>
                    <th>Penyelenggara</th>
                    <th>Tahun</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="5" class="text-center">Data not found</td>
                    </tr>
                @else
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
                @endif
            </table>
        </div>
    </div>
@endsection
