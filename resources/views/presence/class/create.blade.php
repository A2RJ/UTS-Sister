@extends('layouts.dashboard')

@section('title', 'Tambah Kelas')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form tambah civitas</h4>

    <x-form action="{{ route('class.store') }}" displayError="true">
        <x-select name="study_program_id" label="Program studi" :select="$study_program" />
        <x-input name="class" label="Kelas" placeholder="Kelas" />
    </x-form>
</div>
@endsection