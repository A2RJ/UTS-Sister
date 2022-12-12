@extends('layouts.dashboard')

@section('title', 'Tambah Facultas')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form tambah civitas</h4>

    <x-form action="{{ route('faculty.store') }}" displayError="true">
        <x-select name="sdm_id" label="Nama Penanggung Jawab" :select="$human_resources" />
        <x-input name="faculty" label="Nama fakultas" placeholder="Nama fakultas" />
    </x-form>
</div>
@endsection