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
                                    <th>Status Verifikasi</th>
                                    <th>Judul Proposal</th>
                                    <th>Skema Hibah</th>
                                    <th>Target Luaran</th>
                                    <th>File Proposal</th>
                                    <th>Status Ajuan</th>
                                    <th>Periode Kontrak</th>
                                    <th>Jumlah Pendanaan</th>
                                    <th>Judul Publikasi</th>
                                    <th>Status Penulis</th>
                                    <th>Nama Jurnal</th>
                                    <th>Tahun Terbit</th>
                                    <th>Nomor Volume</th>
                                    <th>Tanggal dan Tahun Terbit</th>
                                    <th>Penerbit</th>
                                    <th>Status Akreditasi Jurnal</th>
                                    <th>Link Publikasi Jurnal</th>
                                    <th>File PDF Jurnal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($researches as $index => $research)
                                <tr>
                                    <td>{{ $index + $researches->firstItem() }}</td>
                                    <td>{{ $research->humanResource->sdm_name }}</td>
                                    <td class="text-{{ $research->verification == 'Terverifikasi' ? 'success' : 'danger' }}">{{ $research->verification }}</td>
                                    <td>{{ $research->proposal_title }}</td>
                                    <td>{{ $research->grant_scheme }}</td>
                                    <td>{{ $research->target_outcomes }}</td>
                                    <td>
                                        <a href="{{ route('download.riset', ['filename' => base64_encode($research->proposal_file)]) }}">File</a>
                                    </td>
                                    <td>{{ $research->application_status }}</td>
                                    <td>{{ $research->contract_period }}</td>
                                    <td>{{ $research->funding_amount }}</td>
                                    <td>{{ $research->publication_title }}</td>
                                    <td>{{ $research->author_status }}</td>
                                    <td>{{ $research->journal_name }}</td>
                                    <td>{{ $research->publication_year }}</td>
                                    <td>{{ $research->volume_number }}</td>
                                    <td>{{ $research->publication_date_year }}</td>
                                    <td>{{ $research->publisher }}</td>
                                    <td>{{ $research->journal_accreditation_status }}</td>
                                    <td>
                                        @if ($research->journal_publication_link)
                                        <a href="{{ $research->journal_publication_link }}">Link</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($research->journal_pdf_file)
                                        <a href="{{ route('download.riset', ['filename' => base64_encode($research->journal_pdf_file)]) }}">File</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('proposal.verifyAction', ['proposal' => $research->id]) }}" class="btn btn-{{ $research->verification != 'Terverifikasi' ? 'success' : 'danger' }}">
                                            {{ $research->verification == 'Terverifikasi' ? 'Batal Verifikasi' : 'Verifikasi' }}
                                        </a>
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