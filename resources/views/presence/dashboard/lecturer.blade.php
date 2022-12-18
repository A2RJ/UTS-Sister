@extends('layouts.dashboard')
@section('title', 'Absensi Civitas')

@section('content')
<div class="card p-2">
    <h3>List Pengajaran
        @if (auth()->user()->isDirAkademik())
        Seluruh Civitas
        @endif
    </h3>
    <x-table :header="['Nama', 'Total SKS', 'Action']">
        @foreach ($lecturers as $lecturer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lecturer->sdm_name }}</td>
            <td>{{ $lecturer->total_sks }} SKS</td>
            <td>
                <a href="{{ route('subject.by-lecturer', $lecturer->id) }}">Detail</a>
            </td>
        </tr>
        @endforeach
    </x-table>
    <div class="mt-2 float-right">
        {{ $lecturers->links() }}
    </div>
</div>
@endsection