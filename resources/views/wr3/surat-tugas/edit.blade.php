@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Ajukan Surat Tugas') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('wr3.research-assignment.update', ['researchAssignment' => $researchAssignment->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="number">Number</label>
                            <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="number" value="{{ old('number', $researchAssignment->number ?? '') }}">
                            @error('number') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="month">Month</label>
                            <input type="text" class="form-control @error('month') is-invalid @enderror" name="month" id="month" value="{{ old('month', $researchAssignment->month ?? '') }}">
                            @error('month') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="year">Year</label>
                            <input type="text" class="form-control @error('year') is-invalid @enderror" name="year" id="year" value="{{ old('year', $researchAssignment->year ?? '') }}">
                            @error('year') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mt-3 float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection