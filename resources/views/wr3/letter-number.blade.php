@extends('layouts.dashboard')
@section('title', 'Penomoran Surat')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Penomoran Surat</div>

                <div class="card-body">
                    <form action="{{ $route }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label for="number">Number:</label>
                            <input type="number" id="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" value="{{ old('number', $letterNumber->number ?? '') }}">
                            @if ($errors->has('number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('number') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="month">Month:</label>
                            <input type="number" id="month" class="form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month" value="{{ old('month', $letterNumber->month ?? '') }}">
                            @if ($errors->has('month'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('month') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="year">Year:</label>
                            <input type="number" id="year" class="form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" value="{{ old('year', $letterNumber->year ?? '') }}">
                            @if ($errors->has('year'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection