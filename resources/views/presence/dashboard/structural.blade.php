@extends('layouts.dashboard')
@section('title', 'List Sub Divisi')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List Sub Divisi</h4>

    <x-table :header="['Nama', 'Total Jam', 'Detail']">
        @foreach ($structural as $sub)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sub->sdm_name }}</td>
            <td>
                {{ $sub }}
            </td>
            <td>
                <a href="{{ route('presence.detail', $sub->id) }}">Detail</a>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $structural->links() }}
    </div>
</div>
@endsection