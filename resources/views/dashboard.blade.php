@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <h5 class="mb-3">Nama: {{ Auth::user()->sdm_name }}</h5>
                    <small>Sister ID: {{ session('id_sdm') }}</small>
                    <x-role-dashboard />
                    <livewire:rinov.surat-tugas />
                    <livewire:rinov.aksi-surat-tugas />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection