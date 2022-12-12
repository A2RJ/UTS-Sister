@extends('layouts.dashboard')

@section('title', 'Jabatan Fungsional')

@section('content')
    <div class="card p-2">
        <b>Jabatan Fungsional</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Jabatan Fungsional</th>
                    <th>Nomor SK</th>
                    <th>Terhitung Mulai Tanggal</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="5" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $jafung)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jafung['jabatan_fungsional'] }}</td>
                            <td>{{ $jafung['sk'] }}</td>
                            <td>{{ $jafung['tanggal_mulai'] }}</td>
                            <td>
                                <a href="{{ route('jabatan-fungsional.detail', ['id' => $jafung['id']]) }}">
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
