@extends('layouts.dashboard')

@section('title', 'List Mata Kuliah')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List program studi</h4>

    <x-table :header="['Program Studi']">
        @foreach ($study_programs as $index => $study_program)
        <tr>
            <td>{{ $index + $study_programs->firstItem() }}</td>
            <td>{{ $study_program->role }}</td>
        </tr>
        @endforeach
    </x-table>
</div>
@endsection