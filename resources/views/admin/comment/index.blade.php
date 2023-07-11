@extends('layouts.dashboard')

@section('title', 'List Komentar')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List Komentar</h4>

    <x-search-subject />
    <x-table :header="['Dosen', 'Mata Kuliah', 'Nama', 'NIM', 'Komentar']">
        @foreach ($comments as $index => $semester)
        <tr class="text-capitalize">
            <td>{{ $index + $comments->firstItem() }}</td>
            <td>{{ $semester->sdm_name }}</td>
            <td>{{ $semester->subject }}</td>
            <td>{{ $semester->nama }}</td>
            <td>{{ $semester->nim }}</td>
            <td>{{ $semester->komentar }}</td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $comments->links() }}
    </div>
</div>
@endsection