@extends('layouts.dashboard')

@section('title', 'Update SDM')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form edit civitas:</h4>

    <x-form action="{{ route('human_resource.update', $human_resource->sdm_id) }}" displayError="true">
        @method('PUT')
        <x-input name="sdm_name" label="Nama SDM" placeholder="Nama" :value="$human_resource->sdm_name" />
        <x-input name="email" label="Email" placeholder="Email" :value="$human_resource->email" />
        <x-input name="nidn" label="NIDN" placeholder="NIDN" :value="$human_resource->nidn" />
        <x-input name="nip" label="NIP" placeholder="NIP" :value="$human_resource->nip" :required="false" />
        <x-select name="active_status_name" label="Status" :select="$active_status_name" :current="$human_resource->active_status_name" />
        <x-select name="employee_status" label="Status pegawai" :select="$employee_status" :current="$human_resource->employee_status" />
        <x-select name="sdm_type" label="Tipe pegawai" :select="$sdm_type" :current="$human_resource->sdm_type" />
        <x-select name="is_sister_exist" label="Terdaftar sister" :select="$is_sister_exist" :current="$human_resource->is_sister_exist" />
    </x-form>
</div>
@endsection