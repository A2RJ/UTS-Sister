@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Ajukan Surat Tugas') }}</div>

                <div class="card-body">
                    <livewire:rinov.aksi-surat-tugas data="{{ $researchAssignment }}" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection