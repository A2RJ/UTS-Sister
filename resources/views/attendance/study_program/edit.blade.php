@extends('layouts.dashboard')

@section('title', 'Edit Program Studi')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form program studi</h4>

    <x-form action="{{ route('study_program.update', $study_program->id) }}" displayError="true">
        @method('PUT')
        <x-select name="faculty_id" label="Fakultas" :select="$faculties" :current="$study_program->faculty_id" />
        <x-input name="study_program" label="Program studi" placeholder="Program studi" :value="$study_program->study_program" />
    </x-form>
</div>
@endsection