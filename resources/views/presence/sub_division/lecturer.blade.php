@extends('layouts.dashboard')
@section('title', 'Absensi Civitas')

@section('content')
<div class="card p-2">
    <h3>List Pengajaran</h3>
    <x-table :header="['Nama', 'role', 'type']">
        @foreach ($lecturers as $lecturer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lecturer->sdm_name }}</td>
            <td>{{ $lecturer->role }}</td>
            <td>{{ $lecturer->type }}</td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $lecturers->links() }}
    </div>
</div>
@endsection