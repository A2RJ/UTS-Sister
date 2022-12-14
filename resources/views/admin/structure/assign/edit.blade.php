@extends('layouts.dashboard')

@section('title', 'Assign Jabatan Struktural')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form edit assign jabatan struktural</h4>
    <x-form action="{{ route('assign.update', $assign->id) }}" displayError="true">
        @method('PUT')
        <x-select name="sdm_id" label="Pilih Civitas" :select="$human_resources" :current="$assign->sdm_id" />
        <x-select name="structure_id" label="Pilih Jabatan Struktural" :select="$structurals" :current="$assign->structure_id" />
    </x-form>
</div>
@endsection