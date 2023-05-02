<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    @if ($isFormHide == 'false')
    <button class="btn btn-primary mb-3" wire:click="formToggle" wire:model="isFormHide">Tambah kegiatan</button>
    @else
    <button class="btn btn-primary mb-3" wire:click="formToggle" wire:model="isFormHide">Batal</button>
    @endif

    @if ($isFormHide == 'false')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Lokasi</th>
                    <th>SK</th>
                    <th>Sumber dana</th>
                    <th>Total dana</th>
                    <th>Tanggal pelaksanaan</th>
                    <th>Jumlah mahasiswa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offCampusActivities as $index => $offCampusActivity)
                <tr>
                    <td>{{ $index + $offCampusActivities->firstItem() }}</td>
                    <td>{{ $offCampusActivity->humanResource->sdm_name }}</td>
                    <td>{{ $offCampusActivity->title }}</td>
                    <td>{{ $offCampusActivity->location }}</td>
                    <td>
                        <a href="{{ route('download.riset', ['filename' => base64_encode($offCampusActivity->performance_certificate)]) }}">File</a>
                    </td>
                    <td>{{ $offCampusActivity->budget_source }}</td>
                    <td>{{ $offCampusActivity->funding_amount }}</td>
                    <td>{{ $offCampusActivity->execution_date }}</td>
                    <td>{{ $offCampusActivity->number_of_students }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <form wire:submit.prevent="submit">
        <h3 class="mb-3">Informasi kegiatan di luar kampus (sesuai IKU)</h3>
        <div class=" form-group mb-3">
            <label for="title">Nama Kegiatan:</label>
            <input type="text" id="title" wire:model="title" class="form-control">
            @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="location">Tempat Kegiatan:</label>
            <input type="text" id="location" wire:model="location" class="form-control">
            @error('location') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="performance_certificate">Bukti SK / Kinerja:</label>
            <input type="file" id="performance_certificate" wire:model="performance_certificate" class="form-control">
            @error('performance_certificate') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="budget_source">Sumber Dana:</label>
            <select id="budget_source" wire:model="budget_source" class="form-control">
                <option value="">-- Pilih Sumber Dana --</option>
                @foreach($list_budget_source as $budget_source)
                <option value="{{ $loop->iteration }}">{{ $budget_source }}</option>
                @endforeach
            </select>
            @error('budget_source') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="funding_amount">Jumlah Pendanaan Luar Kampus:</label>
            <input type="number" id="funding_amount" wire:model="funding_amount" class="form-control">
            @error('funding_amount') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="execution_date">Periode / Tgl Pelaksanaan:</label>
            <input type="date" id="execution_date" wire:model="execution_date" class="form-control">
            @error('execution_date') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="students">Daftar Mahasiswa:</label>
            <br>
            <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="addStudent">Tambah mahasiswa</button>
            @error('students') <br> <span class="error text-danger">{{ $message }}</span> @enderror

            <div class="form-row justify-content-center mt-3">
                @foreach ($students as $index => $mhs)
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-1 d-flex align-items-center justify-content-center">
                            <button class="btn btn-sm btn-danger" wire:click.prevent="deleteStudent({{ $index }})">Hapus</button>
                        </div>
                        <div class="form-group mb-2 col-5">
                            <label>Nama:</label>
                            <input type="text" wire:model="students.{{ $index }}.name" class="form-control">
                            @error('students.'.$index.'.name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2 col-5">
                            <label>NIM:</label>
                            <input type="text" wire:model="students.{{ $index }}.nim" class="form-control">
                            @error('students.'.$index.'.nim') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3 float-end">Submit data</button>
        </div>
    </form>
    @endif
</div>