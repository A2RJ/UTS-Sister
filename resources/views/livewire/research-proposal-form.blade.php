<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('fail'))
    <div class="alert alert-danger">
        {{ session()->get('fail') }}
    </div>
    @endif

    @if ($isFormHide == 'false')
    <button class="btn btn-primary mb-3" wire:click="formToggle" wire:model="isFormHide">Tambah proposal</button>
    @else
    <button class="btn btn-primary mb-3" wire:click="formToggle" wire:model="isFormHide">Batal</button>
    @endif

    @if ($isFormHide == 'false')
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
                        <a href="{{ route('download.riset', ['filename' => base64_encode($research->journal_pdf_file)]) }}">File</a>
                    </td>
                    <td>
                        <button class="btn btn-outline-primary mb-2" wire:click="formToggle({{ $research->id }})">Edit</button>
                        <form action="{{ route('rinov.proposal.destroy', $research->id) }}" method="POST">
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
    @else
    <form wire:submit.prevent="{{ $updateId ? 'update' : 'submit' }}">
        <h3 class="mb-3">Informasi Proposal</h3>
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
    @endif
</div>