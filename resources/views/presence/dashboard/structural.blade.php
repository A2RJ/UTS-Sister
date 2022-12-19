@extends('layouts.dashboard')
@section('title', 'List Sub Divisi')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List Sub Divisi</h4>

    <x-search-presence />
    <x-table :header="['Nama', 'Total Jam', 'Detail']">
        @foreach ($presences as $presence)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $presence->sdm_name }}</td>
            <td>
                @if ($presence->hours || $presence->minutes)
                {{ $presence->hours }} Jam {{ $presence->minutes }} Menit

                @endif
            </td>
            <td>
                <a href="{{ route('presence.detail', $presence->id) }}">Detail</a>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $presences->links() }}
    </div>
</div>
@endsection