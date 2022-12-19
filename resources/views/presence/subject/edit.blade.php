@extends('layouts.dashboard')

@section('title', 'Edit Program Studi')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form edit mata kuliah</h4>

    <x-form action="{{ route('subject.update', $subject->id) }}" displayError="true">
        @method('PUT')
        <x-input name="subject" label="Mata Kuliah" placeholder="Mata Kuliah" :value="$subject->subject" />
        <x-input name="sks" label="Jumlah SKS" placeholder="Jumlah SKS" :value="$subject->sks" />
        <x-input name="number_of_meetings" label="Jumlah Pertemuan" placeholder="Jumlah Pertemuan" :value="$subject->number_of_meetings" />
        <x-input name="structure_id" label="Program studi" :value="$study_program[0]->role" :readOnly="true" />
        <x-select name="class_id" label="Kelas" :select="$classes" :current="$subject->class_id" />
        <x-select name="sdm_id" label="Dosen" :select="$human_resources" :current="$subject->sdm_id" />
        <x-select name="semester_id" label="Semester" :select="$semesters" :current="$subject->semester_id" />
    </x-form>
</div>
@endsection