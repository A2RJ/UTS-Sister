@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ url()->current() }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                            <a class="btn btn-outline-secondary" href="{{ url()->current(false, false) }}">Cancel</a>
                            <button class="btn btn-outline-primary">Export</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>SDM Name</th>
                                    <th>Proposal Title</th>
                                    <th>Grant Scheme</th>
                                    <th>Target Outcomes</th>
                                    <th>Proposal File</th>
                                    <th>Application Status</th>
                                    <th>Contract Period</th>
                                    <th>Funding Amount</th>
                                    <th>Verification</th>
                                    <th>Assignment Letter Link</th>
                                    <th>Publication Title</th>
                                    <th>Author Status</th>
                                    <th>Journal Name</th>
                                    <th>Publication Year</th>
                                    <th>Volume Number</th>
                                    <th>Publication Date Year</th>
                                    <th>Publisher</th>
                                    <th>Journal Accreditation Status</th>
                                    <th>Journal Publication Link</th>
                                    <th>Journal PDF File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($researches as $index => $research)
                                <tr>
                                    <td>{{ $index + $researches->firstItem() }}</td>
                                    <td>{{ $research->humanResource->sdm_name }}</td>
                                    <td>{{ $research->proposal_title }}</td>
                                    <td>{{ $research->grant_scheme }}</td>
                                    <td>{{ $research->target_outcomes }}</td>
                                    <td>
                                        <a href="{{ route('download.riset', ['filename' => base64_encode($research->proposal_file)]) }}">File</a>
                                    </td>
                                    <td>{{ $research->application_status }}</td>
                                    <td>{{ $research->contract_period }}</td>
                                    <td>{{ $research->funding_amount }}</td>
                                    <td>{{ $research->verification }}</td>
                                    <td>{{ $research->assignment_letter_link }}</td>
                                    <td>{{ $research->publication_title }}</td>
                                    <td>{{ $research->author_status }}</td>
                                    <td>{{ $research->journal_name }}</td>
                                    <td>{{ $research->publication_year }}</td>
                                    <td>{{ $research->volume_number }}</td>
                                    <td>{{ $research->publication_date_year }}</td>
                                    <td>{{ $research->publisher }}</td>
                                    <td>{{ $research->journal_accreditation_status }}</td>
                                    <td>
                                        <a href="{{ $research->journal_publication_link }}">Link</a>
                                    </td>
                                    <td>
                                        @if ($research->journal_pdf_file)
                                        <a href="{{ route('download.riset', ['filename' => base64_encode($research->journal_pdf_file)]) }}">File</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $researches->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection