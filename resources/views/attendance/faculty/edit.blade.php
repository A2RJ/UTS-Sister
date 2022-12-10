@extends('layouts.dashboard')

@section('title', 'Edit Facultas')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Form edit civitas</h4>

    <x-form action="{{ route('faculty.update', $faculty->id) }}" displayError="true">
        @method('PUT')
        <x-input name="faculty" label="Nama fakultas" placeholder="Nama fakultas" :value="$faculty->faculty" />
    </x-form>
</div>
@endsection