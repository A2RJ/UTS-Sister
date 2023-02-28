@extends('layouts.dashboard')

@section('title', 'Assign Jabatan Struktural')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form assign jabatan struktural</h4>
    <x-form action="{{ route('assign.store') }}" displayError="false">
        <x-select name="sdm_id" label="Pilih Civitas" :select="$human_resources" />
        <x-select name="structure_id" label="Pilih Jabatan Struktural" :select="$structurals" />
    </x-form>
</div>
@endsection