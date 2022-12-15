@extends('layouts.dashboard')

@section('title', 'Edit Kelas')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form edit kelas</h4>

    <x-form action="{{ route('class.update', $class->id) }}" displayError="true">
        @method('PUT')
        <x-input name="structure_id" label="Program studi" :value="$study_program[0]->role" :readOnly="true" />
        <x-input name="class" label="Kelas" placeholder="Kelas" :value="$class->class" />
    </x-form>
</div>
@endsection