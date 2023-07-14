@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit pengabdian</div>

                <div class="card-body">
                    <form action="{{ route('dedication.update', $dedication->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="title">Title:</label>
                            <input type="text" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $dedication->title) }}" required>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="funding_source">Funding Source:</label>
                            <input type="text" id="funding_source" class="form-control{{ $errors->has('funding_source') ? ' is-invalid' : '' }}" name="funding_source" value="{{ old('funding_source', $dedication->funding_source) }}" required>
                            @if ($errors->has('funding_source'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('funding_source') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="funding_amount">Funding Amount:</label>
                            <input type="number" id="funding_amount" class="form-control{{ $errors->has('funding_amount') ? ' is-invalid' : '' }}" name="funding_amount" value="{{ old('funding_amount', $dedication->funding_amount) }}" required>
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
                            <label for="activity_schedule">Activity Schedule:</label>
                            <input type="text" id="activity_schedule" class="form-control{{ $errors->has('activity_schedule') ? ' is-invalid' : '' }}" name="activity_schedule" value="{{ old('activity_schedule', $dedication->activity_schedule) }}" required>
                            @if ($errors->has('activity_schedule'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('activity_schedule') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="location">Location:</label>
                            <input type="text" id="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location', $dedication->location) }}" required>
                            @if ($errors->has('location'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="participants">Participants:</label>
                            <input type="text" id="participants" class="form-control{{ $errors->has('participants') ? ' is-invalid' : '' }}" name="participants" value="{{ old('participants', $dedication->participants) }}" required>
                            @if ($errors->has('participants'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('participants') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="target_activity_outputs">Target Activity Outputs:</label>
                            <input type="text" id="target_activity_outputs" class="form-control{{ $errors->has('target_activity_outputs') ? ' is-invalid' : '' }}" name="target_activity_outputs" value="{{ old('target_activity_outputs', $dedication->target_activity_outputs) }}" required>
                            @if ($errors->has('target_activity_outputs'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('target_activity_outputs') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="public_media_publications">Media Publication Outcome:</label>
                            <input type="text" id="public_media_publications" class="form-control{{ $errors->has('public_media_publications') ? ' is-invalid' : '' }}" name="public_media_publications" value="{{ old('public_media_publications', $dedication->public_media_publications) }}" required>
                            @if ($errors->has('public_media_publications'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('public_media_publications') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="scientific_publications">Scientific Publication Outcome:</label>
                            <input type="text" id="scientific_publications" class="form-control{{ $errors->has('scientific_publications') ? ' is-invalid' : '' }}" name="scientific_publications" value="{{ old('scientific_publications', $dedication->scientific_publications) }}" required>
                            @if ($errors->has('scientific_publications'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('scientific_publications') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <label for="members">Members:</label>
                            <input type="text" id="members" class="form-control{{ $errors->has('members') ? ' is-invalid' : '' }}" name="members" value="{{ old('members', $dedication->members) }}" required>
                            @if ($errors->has('members'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('members') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Update Dedication</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection