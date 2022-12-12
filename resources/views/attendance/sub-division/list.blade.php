@extends('layouts.dashboard')
@section('title', 'List Sub Divisi')

@section('content')
<div class="card p-2">
    <h4 class="mb-4">List Sub Divisi</h4>

    <x-table :header="['Nama', 'Aksi']">

        @foreach ($subdivision as $sub)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $sub->role }}</td>
            <td><a href="#">Detail Absesnsi</a></td>
        </tr>
        @endforeach
    </x-table>
</div>
@endsection