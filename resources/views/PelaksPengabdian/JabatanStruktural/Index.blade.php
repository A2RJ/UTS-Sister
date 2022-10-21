@extends('layout.dashboard')

@section('title', 'Jabatan Struktural')

@section('content')
    <div class="card p-2">
        <b>Jabatan Struktural</b>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td>No.</td>
                    <td>Jabatan Struktural</td>
                    <td>Nomor SK</td>
                    <td>Terhitung Tanggal Mulai</td>
                    <td>Terhitung Tanggal Selesai</td>
                    <td>Aksi</td>
                </tr>
                @if (count($data) === 0)
                    <tr>
                        <td colspan="6" class="text-center">Data not found</td>
                    </tr>
                @else
                    @foreach ($data as $jabatanStruktural)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jabatanStruktural['jabatan'] }}</td>
                            <td>{{ $jabatanStruktural['sk_jabatan'] }}</td>
                            <td>{{ $jabatanStruktural['tanggal_mulai_jabatan'] }}</td>
                            <td>{{ $jabatanStruktural['tanggal_selesai_jabatan'] }}</td>
                            <td>
                                <a href="{{ route('jabatan-struktural.detail', ['id' => $jabatanStruktural['id']]) }}">
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
