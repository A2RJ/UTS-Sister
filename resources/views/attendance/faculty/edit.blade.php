@extends('layouts.dashboard')

@section('title', 'Edit Facultas')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form edit civitas</h4>

    <x-form action="{{ route('faculty.update', $faculty->id) }}" displayError="true">
        @method('PUT')
        <x-select name="sdm_id" label="Nama Penanggung Jawab" :select="$human_resources" :cureent="$faculty->sdm_id" />
        <x-input name="faculty" label="Nama fakultas" placeholder="Nama fakultas" :value="$faculty->faculty" />
    </x-form>
</div>
@endsection