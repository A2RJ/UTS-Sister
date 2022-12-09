@extends('layouts.dashboard')

@section('title', 'Create SDM')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form tambah civitas</h4>

    <x-form action="{{ route('human_resource.store') }}" displayError="true">
        @csrf
        <x-input name="sdm_name" label="Nama SDM" placeholder="Nama" />
        <x-input name="nidn" label="NIDN" placeholder="NIDN" />
        <x-input name="nip" label="NIP" placeholder="NIP" />
        <x-select name="active_status_name" label="Status" :select="$active_status_name" />
        <x-select name="employee_status" label="Status pegawai" :select="$employee_status" />
        <x-select name="sdm_type" label="Tipe pegawai" :select="$sdm_type" />
        <x-select name="is_sister_exist" label="Terdaftar sister" :select="$is_sister_exist" />
        <x-select name="faculty_id" label="Fakultas" :select="$faculty" />
        <x-select name="study_program_id" label="Program studi" :select="$study_program" />
        <x-select name="structure_id" label="Jabatan struktural" :select="$structure" />
    </x-form>
</div>
@endsection