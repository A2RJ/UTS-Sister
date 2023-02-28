@extends('layouts.dashboard')

@section('title', 'Tambah Semester')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form Semester</h4>
    <x-form action="{{ route('semester.store') }}" displayError="false">
        <x-input name="semester" label="Semester" placeholder="Ex: Ganjil 2022/2023" />
    </x-form>
</div>
@endsection