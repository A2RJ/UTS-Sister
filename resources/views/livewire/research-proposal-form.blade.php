<div class="container mt-5">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <form wire:submit.prevent="submit">
        <h3 class="mb-3 mt-4">Informasi Proposal</h3>
        <div class="form-group mb-2">
            <label for="proposal_title">Judul Proposal:</label>
            <input type="text" id="proposal_title" wire:model="proposal_title" class="form-control">
            @error('proposal_title') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="grant_scheme">Skema Hibah:</label>
            <input type="text" id="grant_scheme" wire:model="grant_scheme" class="form-control">
            @error('grant_scheme') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="target_outcomes">Target Luaran:</label>
            <textarea id="target_outcomes" wire:model="target_outcomes" class="form-control"></textarea>
            @error('target_outcomes') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="proposal_file">Upload Proposal (WORD atau PDF):</label> <br>
            <input type="file" id="proposal_file" wire:model="proposal_file" class="form-control">
            @error('proposal_file') <br> <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="application_status">Status Ajuan:</label>
            <select id="application_status" wire:model="application_status" class="form-control">
                <option value="">-- Pilih Status Ajuan --</option>
                @foreach ($statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
            @error('application_status') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        @if ($application_status == 'Lolos pendanaan')
        <div class="form-group mb-2">
            <label for="contract_period">Periode Kontrak:</label>
            <input type="text" id="contract_period" wire:model="contract_period" class="form-control">
            @error('contract_period') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="funding_amount">Jumlah Pendanaan:</label>
            <input type="text" id="funding_amount" wire:model="funding_amount" class="form-control">
            @error('funding_amount') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="assignment_letter_link">Pengajuan Surat Tugas (Link):</label>
            <input type="text" id="assignment_letter_link" wire:model="assignment_letter_link" class="form-control">
            @error('assignment_letter_link') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
        @endif

        <div class="form-group mb-2">
            <label for="publication_title">Judul Publikasi:</label>
            <input type="text" id="publication_title" wire:model="publication_title" class="form-control">
            @error('publication_title') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="author_status">Status Penulis:</label>
            <select wire:model="author_status" class="form-control" id="author_status">
                <option value="">--- Pilih Status Penulis ---</option>
                @foreach ($author_statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
            @error('author_status') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="journal_name">Nama Jurnal:</label>
            <input type="text" id="journal_name" wire:model="journal_name" class="form-control">
            @error('journal_name') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="journal_pdf_file">Upload File Jurnal (WORD atau PDF):</label>
            <input type="file" id="journal_pdf_file" wire:model="journal_pdf_file" class="form-control">
            @error('journal_pdf_file') <br> <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="publication_year">Tahun:</label>
            <input type="number" id="publication_year" wire:model="publication_year" class="form-control">
            @error('publication_year') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="volume_number">Vol/No.:</label>
            <input type="text" id="volume_number" wire:model="volume_number" class="form-control">
            @error('volume_number') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="publication_date_year">Tanggal dan Tahun Terbit:</label>
            <input type="date" id="publication_date_year" wire:model="publication_date_year" class="form-control">
            @error('publication_date_year') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="publisher">Penerbit:</label>
            <input type="text" id="publisher" wire:model="publisher" class="form-control">
            @error('publisher') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="journal_accreditation_status">Status Akreditasi Jurnal:</label>
            <select wire:model="journal_accreditation_status" class="form-control" id="journal_accreditation_status">
                <option value="">--- Pilih Status Penulis ---</option>
                @foreach ($journal_accreditation_statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
            @error('journal_accreditation_status') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="journal_publication_link">Link Publikasi Jurnal:</label>
            <input type="text" id="journal_publication_link" wire:model="journal_publication_link" class="form-control">
            @error('journal_publication_link') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3 float-end">Submit data</button>
        </div>
    </form>
</div>