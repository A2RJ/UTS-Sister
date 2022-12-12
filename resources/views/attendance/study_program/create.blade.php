@extends('layouts.dashboard')

@section('title', 'Tambah Program Studi')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form program studi</h4>

    <x-form action="{{ route('study_program.store') }}" displayError="true">
        <x-select name="faculty_id" label="Fakultas" :select="$faculties" />
        <x-select name="sdm_id" label="Nama Penanggung Jawab" :select="$human_resources" />
        <x-input name="study_program" label="Program studi" placeholder="Program studi" />
    </x-form>
</div>
@endsection