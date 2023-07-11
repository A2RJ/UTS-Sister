@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Daftar kegiatan di luar kampus</div>

                <div class="card-body">
                    <livewire:off-campus-activity-form />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection