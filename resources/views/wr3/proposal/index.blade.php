@extends('layouts.dashboard')
@section('title', 'Daftar Proposal')

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
                                    <th>Nama Dosen</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul Proposal</th>
                                    <th>Skema Hibah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($researches as $index => $research)
                                <tr>
                                    <td>{{ $index + $researches->firstItem() }}</td>
                                    <td>{{ $research->humanResource->sdm_name }}</td>
                                    <td>
                                        @if ($research->letterNumber?->number | $research->letterNumber?->month | $research->letterNumber?->year)
                                        {{ $research->letterNumber?->number }}/{{ $research->letterNumber?->month }}/{{ $research->letterNumber?->year }}
                                        @endif
                                    </td>
                                    <td>{{ $research->proposal_title }}</td>
                                    <td>{{ $research->grant_scheme }}</td>
                                    <td>
                                        <a href="{{ route('proposal.formNumbering', $research->id) }}" class="btn btn-warning">Edit nomor surat</a>
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