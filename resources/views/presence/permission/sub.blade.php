@extends('layouts.dashboard')
@section('title', 'Ijin Sub Divisi')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Input Absensi</h4>
    <form action="{{ route('presence.permission') }}" method="post" enctype="multipart/form-data">
        @csrf

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-success">
            {{ session()->get('error') }}
        </div>
        @endif

        <div class="mb-3">
            <label for="jenis_izin" class="form-label">Jenis izin</label>
            <select class="form-select @if ($errors->has('jenis_izin')) is-invalid @endif" name="jenis_izin">
                <option selected disabled>Pilih jenis izin</option>
                @foreach ($jenis_izin as $i => $label)
                <option value="{{ $i + 1 }}" {{ old('jenis_izin', $izin ?? null) == ($i+1) ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            @if ($errors->has('jenis_izin'))
            <div class="invalid-feedback">{{ $errors->first('jenis_izin') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">File</label>
            <input type="file" class="form-control @if ($errors->has('attachment')) is-invalid @endif" id="attachment" name="attachment" placeholder="Pilih file">
            @if ($errors->has('attachment'))
            <div class="invalid-feedback">{{ $errors->first('attachment') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Dari tanggal</label>
            <input type="date" class="form-control @if ($errors->has('start_date')) is-invalid @endif" id="start_date" name="start_date" value="{{ old('start_date', $start_date ?? null) }}" placeholder="Pilih file">
            @if ($errors->has('start_date'))
            <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Sampai tanggal</label>
            <input type="date" class="form-control @if ($errors->has('end_date')) is-invalid @endif" id="end_date" name="end_date" value="{{ old('end_date', $end_date ?? null) }}" placeholder="Pilih file">
            @if ($errors->has('end_date'))
            <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="detail" class="form-label">Detail</label>
            <textarea class="form-control @if ($errors->has('detail')) is-invalid @endif" id="detail" name="detail" rows="3">{{ old('detail', $detail ?? null) }}</textarea>
            @if ($errors->has('detail'))
            <div class="invalid-feedback">{{ $errors->first('detail') }}</div>
            @endif
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection