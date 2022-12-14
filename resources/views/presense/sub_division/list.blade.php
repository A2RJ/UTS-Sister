@extends('layouts.dashboard')
@section('title', 'List Sub Divisi')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List Sub Divisi</h4>

    <x-table :header="['Nama', 'role', 'type']">
        @foreach ($subdivision as $sub)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sub->sdm_name }}</td>
            <td>{{ $sub->structure->role }}</td>
            <td>{{ $sub->structure->type }}</td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $subdivision->links() }}
    </div>
</div>
@endsection