@extends('layouts.dashboard')
@section('title', 'Presence')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Input Absensi</h4>
    <form action="{{ route('presence.permission') }}" method="post" enctype="multipart/form-data">
        @csrf

        <x-success-message />
        <x-error-message />

        <div class="mb-3">
            <label for="jenis_izin" class="form-label">Jenis izin</label>
            <select class="form-select" aria-label="Default select example" name="jenis_izin">
                <option selected disabled>Pilih jenis izin</option>
                @foreach ($jenis_izin as $i => $label)
                <option value="{{ $i + 1 }}" {{ old('izin') == ($i+1) ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @if ($errors->has('jenis_izin'))
            <div class="alert alert-danger">{{ $errors->first('jenis_izin') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">File</label>
            <input type="file" class="form-control" id="attachment" name="attachment" placeholder="Pilih file">
            @if ($errors->has('attachment'))
            <div class="alert alert-danger">{{ $errors->first('attachment') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Detail</label>
            <textarea class="form-control" id="detail" name="detail" rows="3">{{ old('detail') }}</textarea>
            @if ($errors->has('detail'))
            <div class="alert alert-danger">{{ $errors->first('detail') }}</div>
            @endif
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection