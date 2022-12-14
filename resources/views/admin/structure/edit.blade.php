@extends('layouts.dashboard')

@section('title', 'Edit Jabatan Struktural')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form edit jabatan struktual</h4>
    <x-form action="{{ route('structure.update', $structure->id) }}" displayError="true">
        @method('PUT')
        <x-select name="parent_id" label="Pilih top level" :select="$parent" :current="$structure->parent_id" />
        <x-select name="type" label="Pilih tipe" :select="$types" :current="$structure->type" />
        <x-input name="role" label="Jabatan" placeholder="Nama jabatan" :value="$structure->role" />
    </x-form>

</div>
@endsection