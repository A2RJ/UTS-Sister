@extends('layouts.dashboard')

@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form mata kuliah</h4>

    <x-form action="{{ route('subject.store') }}" displayError="false">
        <x-input name="subject" label="Mata Kuliah" placeholder="Mata Kuliah" />
        <x-input name="sks" label="Jumlah SKS" placeholder="Jumlah SKS" />
        <x-input name="number_of_meetings" label="Jumlah Pertemuan" placeholder="Jumlah Pertemuan" />
        <x-input name="structure_id" label="Program studi" :value="$study_program[0]->role" :readOnly="true" />
        <x-select name="class_id" label="Kelas" :select="$classes" />
        <x-select name="semester_id" label="Semseter" :select="$semesters" />
        <x-select name="sdm_id" label="Dosen" :select="$human_resources" />
    </x-form>
</div>
@endsection