@extends('layouts.dashboard')

@section('title', 'Tambah SDM')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form tambah civitas</h4>

    <x-form action="{{ route('human_resource.store') }}" displayError="false">
        <x-input name="sdm_name" label="Nama SDM" placeholder="Nama" />
        <x-input name="email" label="Email" placeholder="Email" />
        <x-input name="nidn" label="NIDN" placeholder="NIDN" />
        <x-input name="nip" label="NIP" placeholder="NIP" :required="false" />
        <x-select name="active_status_name" label="Status" :select="$active_status_name" />
        <x-select name="employee_status" label="Status pegawai" :select="$employee_status" />
        <x-select name="sdm_type" label="Tipe pegawai" :select="$sdm_type" />
        <x-select name="is_sister_exist" label="Terdaftar sister" :select="$is_sister_exist" />
    </x-form>
</div>
@endsection