@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Daftar Proposal</div>

                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('failed'))
                    <div class="alert alert-danger">
                        {{ session()->get('failed') }}
                    </div>
                    @endif
                    <div class="mb-3">
                        <a href="{{ route('proposal.create') }}" class="btn btn-primary">Tambah proposal</a>
                    </div>
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
                                    <th>Judul Proposal</th>
                                    <th>Skema Hibah</th>
                                    <th>Target Luaran</th>
                                    <th>File Proposal</th>
                                    <th>Status Ajuan</th>
                                    <th>Periode Kontrak</th>
                                    <th>Jumlah Pendanaan</th>
                                    <th>Verifikasi</th>
                                    <th>Link Surat Tugas</th>
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
                                    <td>
                                        <a href="{{ route('proposal.edit', ['proposal' => $research->id]) }}">
                                            <button class="btn btn-outline-primary mb-2">Edit</button>
                                        </a>
                                        <form action="{{ route('proposal.destroy', ['proposal' => $research->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus item ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection