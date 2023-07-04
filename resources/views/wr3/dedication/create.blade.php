@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Create pengabdian</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dedication.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="title">Title:</label>
                            <input type="text" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="funding_source">Sumber Pendanaan:</label>
                            <input type="text" id="funding_source" class="form-control{{ $errors->has('funding_source') ? ' is-invalid' : '' }}" name="funding_source" value="{{ old('funding_source') }}">
                            @if ($errors->has('funding_source'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('funding_source') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="funding_amount">Jumlah Pendanaan:</label>
                            <input type="number" id="funding_amount" class="form-control{{ $errors->has('funding_amount') ? ' is-invalid' : '' }}" name="funding_amount" value="{{ old('funding_amount') }}">
                            @if ($errors->has('funding_amount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('funding_amount') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="proposal_file">Proposal File:</label>
                            <input type="file" id="proposal_file" class="form-control{{ $errors->has('proposal_file') ? ' is-invalid' : '' }}" name="proposal_file">
                            @if ($errors->has('proposal_file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proposal_file') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="activity_schedule">Waktu Kegiatan:</label>
                            <input type="date" id="activity_schedule" class="form-control{{ $errors->has('activity_schedule') ? ' is-invalid' : '' }}" name="activity_schedule" value="{{ old('activity_schedule') }}">
                            @if ($errors->has('activity_schedule'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('activity_schedule') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="location">Tempat:</label>
                            <input type="text" id="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location') }}">
                            @if ($errors->has('location'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="participants">Peserta:</label>
                            <input type="text" id="participants" class="form-control{{ $errors->has('participants') ? ' is-invalid' : '' }}" name="participants" value="{{ old('participants') }}">
                            @if ($errors->has('participants'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('participants') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="target_activity_outputs">Target Luaran Kegiatan:</label>
                            <textarea id="target_activity_outputs" class="form-control{{ $errors->has('target_activity_outputs') ? ' is-invalid' : '' }}" name="target_activity_outputs" rows="4">{{ old('target_activity_outputs') }}</textarea>
                            @if ($errors->has('target_activity_outputs'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('target_activity_outputs') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="public_media_publications">Luaran Publikasi Media Masa:</label>
                            <textarea id="public_media_publications" class="form-control{{ $errors->has('public_media_publications') ? ' is-invalid' : '' }}" name="public_media_publications" rows="4">{{ old('public_media_publications') }}</textarea>
                            @if ($errors->has('public_media_publications'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('public_media_publications') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="scientific_publications">Luaran Publikasi Ilmiah:</label>
                            <textarea id="scientific_publications" class="form-control{{ $errors->has('scientific_publications') ? ' is-invalid' : '' }}" name="scientific_publications" rows="4">{{ old('scientific_publications') }}</textarea>
                            @if ($errors->has('scientific_publications'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('scientific_publications') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="members">Anggota:</label>
                            <input type="text" id="members" class="form-control{{ $errors->has('members') ? ' is-invalid' : '' }}" name="members" value="{{ old('members') }}">
                            @if ($errors->has('members'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('members') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="assignment_letter_link">Link Surat Tugas:</label>
                            <input type="text" id="assignment_letter_link" class="form-control{{ $errors->has('assignment_letter_link') ? ' is-invalid' : '' }}" name="assignment_letter_link" value="{{ old('assignment_letter_link') }}">
                            @if ($errors->has('assignment_letter_link'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('assignment_letter_link') }}</strong>
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