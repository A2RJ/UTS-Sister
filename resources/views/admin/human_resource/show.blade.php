@extends('layouts.dashboard')

@section('title', 'Update SDM')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Detail civitas:</h4>

    <x-input name="sdm_name" label="Nama SDM" placeholder="Nama" :value="$human_resource->sdm_name" />
    <x-input name="nidn" label="NIDN" placeholder="NIDN" :value="$human_resource->nidn" />
    <x-input name="nip" label="NIP" placeholder="NIP" :value="$human_resource->nip" />
    <x-select name="active_status_name" label="Status" :select="$active_status_name" :current="$human_resource->active_status_name" />
    <x-select name="employee_status" label="Status pegawai" :select="$employee_status" :current="$human_resource->employee_status" />
    <x-select name="sdm_type" label="Tipe pegawai" :select="$sdm_type" :current="$human_resource->sdm_type" />
    <x-select name="is_sister_exist" label="Terdaftar sister" :select="$is_sister_exist" :current="$human_resource->is_sister_exist" />
</div>
@endsection