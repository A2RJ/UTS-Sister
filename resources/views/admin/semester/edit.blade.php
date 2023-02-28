@extends('layouts.dashboard')

@section('title', 'Edit Semester')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form Semester</h4>
    <x-form action="{{ route('semester.update', $semester->id) }}" displayError="false">
        @method('PUT')
        <x-input name="semester" label="Semester" placeholder="Ex: Ganjil 2022/2023" :value="$semester->semester" />
    </x-form>
</div>
@endsection