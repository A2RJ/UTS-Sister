@extends('layouts.dashboard')

@section('title', 'Edit Presensi Kehadiran')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form Presensi Kehadiran</h4>

    <x-form action="{{ route('presence.update', $presence->id) }}" displayError="true">
        @method('PUT')
        <x-select name="sdm_id" label="Dosen" :select="$human_resources" :current="$presence->sdm_id" />
        <x-input name="check_in_time" type="datetime-local" label="Jam Masuk" placeholder="Jam Masuk" :value="$presence->check_in_time" />
        <x-input name="check_out_time" type="datetime-local" label="Jam Pulang" placeholder="Jam Pulang" :value="$presence->check_out_time" />
    </x-form>
</div>
@endsection