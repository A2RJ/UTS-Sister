@extends('layouts.dashboard')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form mata kuliah</h4>

    <x-form action="{{ route('subject.store') }}" displayError="true">
        <x-input name="subject" label="Mata Kuliah" placeholder="Mata Kuliah" />
        <x-input name="sks" label="Jumlah SKS" placeholder="Jumlah SKS" />
        <x-input name="number_of_meetings" label="Jumlah Pertemuan" placeholder="Jumlah Pertemuan" />
        <x-select name="study_program_id" label="Program Studi" :select="$study_programs" />
        <x-select name="sdm_id" label="Dosen" :select="$human_resources" />
    </x-form>
</div>
@endsection