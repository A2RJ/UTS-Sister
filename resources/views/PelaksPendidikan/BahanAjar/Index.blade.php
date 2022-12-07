@extends('layouts.dashboard')

@section('title', 'Bahan Ajar')

@section('content')
    <div class="card p-2">
        <b>Bahan Ajar</b>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Judul Bahan Ajar</th>
                    <th>ISBN</th>
                    <th>Tanggal Terbit</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="6" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $bahanAjar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bahanAjar['judul'] }}</td>
                            <td>{{ $bahanAjar['isbn'] }}</td>
                            <td>{{ $bahanAjar['tanggal_terbit'] }}</td>
                            <td>{{ $bahanAjar['nama_penerbit'] }}</td>
                            <td>
                                <a href="{{ route('bahan-ajar.detail', ['id' => $bahanAjar['id']]) }}">
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
