@extends('layouts.dashboard')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">List Civitas</h4>
    <x-table :header="['Nama', 'Email', 'NIDN', 'NIP', 'Tipe SDM', 'Employee Status', 'Sister']">
        @foreach ($human_resources as $index => $human_resource)
        <tr>
            <td>{{ $index + $human_resources->firstItem() }}</td>
            <td>{{ $human_resource->sdm_name }}</td>
            <td>{{ $human_resource->email }}</td>
            <td>{{ $human_resource->nidn }}</td>
            <td>{{ $human_resource->nip }}</td>
            <td>{{ $human_resource->sdm_type }}</td>
            <td>{{ $human_resource->employee_status }}</td>
            <td>{{ $human_resource->is_sister_exist }}</td>
        </tr>
        @endforeach
    </x-table>
</div>
@endsection