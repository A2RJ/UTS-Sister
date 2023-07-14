@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Ubah Proposal</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('proposal.update', ['proposal' => $proposal->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3 class="mb-3">Edit Proposal</h3>
                        <div class="form-group mb-2">
                            <label for="proposal_title">Judul Proposal:</label>
                            <input type="text" id="proposal_title" name="proposal_title" class="form-control" value="{{ old('proposal_title', $proposal->proposal_title ?? '') }}">
                            @error('proposal_title') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="grant_scheme">Skema Hibah:</label>
                            <input type="text" id="grant_scheme" name="grant_scheme" class="form-control" value="{{ old('grant_scheme', $proposal->grant_scheme ?? '') }}">
                            @error('grant_scheme') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="target_outcomes">Target Luaran:</label>
                            <textarea id="target_outcomes" name="target_outcomes" class="form-control">{{ old('target_outcomes', $proposal->target_outcomes ?? '') }}</textarea>
                            @error('target_outcomes') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="proposal_file">Upload Proposal (WORD atau PDF):</label> <br>
                            <input type="file" id="proposal_file" name="proposal_file" class="form-control">
                            @error('proposal_file') <br> <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="contract_period">Periode Kontrak:</label>
                            <input type="text" id="contract_period" name="contract_period" class="form-control" value="{{ old('contract_period', $proposal->contract_period ?? '') }}">
                            @error('contract_period') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="funding_amount">Jumlah Pendanaan:</label>
                            <input type="text" id="funding_amount" name="funding_amount" class="form-control" value="{{ old('funding_amount', $proposal->funding_amount ?? '') }}">
                            @error('funding_amount') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="application_status">Status Ajuan:</label>
                            <select id="application_status" name="application_status" class="form-control">
                                <option value="">-- Pilih Status Ajuan --</option>
                                @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ old('application_status', $proposal->application_status ?? '') == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                                @endforeach
                            </select>
                            @error('application_status')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="additionalFields" style="display: none">
                            <div class="form-group mb-2">
                                <label for="publication_title">Judul Publikasi:</label>
                                <input type="text" id="publication_title" name="publication_title" class="form-control" value="{{ old('publication_title', $proposal->publication_title ?? '') }}">
                                @error('publication_title') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="author_status">Status Penulis:</label>
                                <select name="author_status" class="form-control" id="author_status">
                                    <option value="">--- Pilih Status Penulis ---</option>
                                    @foreach ($author_statuses as $status)
                                    <option value="{{ $status }}" {{ old('author_status', $proposal->author_status ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('author_status') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="journal_name">Nama Jurnal:</label>
                                <input type="text" id="journal_name" name="journal_name" class="form-control" value="{{ old('journal_name', $proposal->journal_name ?? '') }}">
                                @error('journal_name') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="journal_pdf_file">Upload File Jurnal (WORD atau PDF):</label>
                                <input type="file" id="journal_pdf_file" name="journal_pdf_file" class="form-control">
                                @error('journal_pdf_file') <br> <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="publication_year">Tahun:</label>
                                <input type="number" id="publication_year" name="publication_year" class="form-control" value="{{ old('publication_year', $proposal->publication_year ?? '') }}">
                                @error('publication_year') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="volume_number">Vol/No.:</label>
                                <input type="text" id="volume_number" name="volume_number" class="form-control" value="{{ old('volume_number', $proposal->volume_number ?? '') }}">
                                @error('volume_number') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="publication_date_year">Tanggal dan Tahun Terbit:</label>
                                <input type="date" id="publication_date_year" name="publication_date_year" class="form-control" value="{{ old('publication_date_year', $proposal->publication_date_year ?? '') }}">
                                @error('publication_date_year') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="publisher">Penerbit:</label>
                                <input type="text" id="publisher" name="publisher" class="form-control" value="{{ old('publisher', $proposal->publisher ?? '') }}">
                                @error('publisher') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="journal_accreditation_status">Status Akreditasi Jurnal:</label>
                                <select name="journal_accreditation_status" class="form-control" id="journal_accreditation_status">
                                    <option value="">--- Pilih Status Penulis ---</option>
                                    @foreach ($journal_accreditation_statuses as $status)
                                    <option value="{{ $status }}" {{ old('journal_accreditation_status', $proposal->journal_accreditation_status ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('journal_accreditation_status') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-2">
                                <label for="journal_publication_link">Link Publikasi Jurnal:</label>
                                <input type="text" id="journal_publication_link" name="journal_publication_link" class="form-control" value="{{ old('journal_publication_link', $proposal->journal_publication_link ?? '') }}">
                                @error('journal_publication_link') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mt-3 float-end">Submit data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var applicationStatus = document.getElementById('application_status');
        var additionalFields = document.getElementById('additionalFields');

        // Atur tampilan awal berdasarkan nilai old
        if (applicationStatus.value === 'Selesai penelitian') {
            additionalFields.style.display = 'block';
        } else {
            additionalFields.style.display = 'none';
        }

        applicationStatus.addEventListener('change', function() {
            var selectedStatus = applicationStatus.value;

            if (selectedStatus === 'Selesai penelitian') {
                additionalFields.style.display = 'block';
            } else {
                additionalFields.style.display = 'none';
            }
        });
    });
</script>
@endsection