@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <b>Inpassing</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No.</th>
                    <th>Pangkat/Golongan</th>
                    <th>Nomor SK</th>
                    <th>Tanggal SK</th>
                    <th>Terhitung Mulai Tanggal</th>
                    <th>Aksi</th>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="6" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $inpassing)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inpassing['pangkat_golongan'] }}</td>
                            <td>{{ $inpassing['sk'] }}</td>
                            <td>{{ $inpassing['tanggal_sk'] }}</td>
                            <td>{{ $inpassing['tanggal_mulai'] }}</td>
                            <td>
                                <a href="{{ route('inpassing.detail', ['id' => $inpassing['id']]) }}">
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
