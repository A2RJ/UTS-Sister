@extends('layouts.dashboard')

@section('title', 'Detasering')

@section('content')
<div class="card p-2">
    <b>Detasering</b>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Perguruan Tinggi Sasaran</th>
                <th>Kategori Kegiatan</th>
                <th>No. SK Penugasan</th>
                <th>Tanggal SK Penugasan</th>
                <th>Aksi</th>
            </tr>
            @if (count($data) === 0)
            <tr>
                <td colspan="6" class="text-center">Data not found</td>
            </tr>
            @else
            @foreach ($data as $detasering)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detasering['perguruan_tinggi'] }}</td>
                <td>{{ $detasering['kategori_kegiatan'] }}</td>
                <td>{{ $detasering['sk_penugasan'] }}</td>
                <td>{{ $detasering['tanggal_sk_penugasan'] }}</td>
                <td>
                    <a href="{{ route('detasering.detail', ['id' => $detasering['id']]) }}">
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