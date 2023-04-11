@extends('layouts.dashboard')
@section('title', 'List Sub Divisi')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List Sub Divisi</h4>

    <x-search-presence withDate="{{ $withDate ?? false }}" exportUrl="{{ $exportUrl ?? false }}" />
    <x-table :header="['Nama', 'Jabatan', 'Jam Efektif', 'Detail']">
        @foreach ($presences as $presence)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $presence->sdm_name }}</td>
            <td>{{ $presence->roles() }}</td>
            <td>{{ $presence->effective_hours }}</td>
            <td><a href="{{ route('presence.per-civitas', $presence->id) }}">Detail</a></td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $presences->links() }}
    </div>
</div>
@endsection