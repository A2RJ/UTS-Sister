@extends('layouts.dashboard')
@section('title', 'Ajukan surat tugas')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Ajukan Surat Tugas') }}</div>

                <div class="card-body">
                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('wr3.research-assignment.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" value="{{ auth()->user()->sdm_name }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control" id="nidn" value="{{ auth()->user()->nidn }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Jabatan</label>
                            <input type="text" class="form-control @error('role') is-invalid @enderror" name="role" id="role" value="{{ old('role') }}">
                            @error('role') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="activity">Kegiatan</label>
                            <input type="text" class="form-control @error('activity') is-invalid @enderror" name="activity" id="activity" value="{{ old('activity') }}">
                            @error('activity') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="as">Sebagai</label>
                            <input type="text" class="form-control @error('as') is-invalid @enderror" name="as" id="as" value="{{ old('as') }}">
                            @error('as') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="theme">Tema</label>
                            <input type="text" class="form-control @error('theme') is-invalid @enderror" name="theme" id="theme" value="{{ old('theme') }}">
                            @error('theme') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="dateStart">Mulai Tanggal</label>
                            <input type="date" class="form-control @error('dateStart') is-invalid @enderror" name="dateStart" id="dateStart" value="{{ old('dateStart') }}">
                            @error('dateStart') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="dateEnd">Selesai Tanggal (Opsional)</label>
                            <input type="date" class="form-control @error('dateEnd') is-invalid @enderror" name="dateEnd" id="dateEnd" value="{{ old('dateEnd') }}">
                            @error('dateEnd') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="organizer">Penyelenggara</label>
                            <input type="text" class="form-control @error('organizer') is-invalid @enderror" name="organizer" id="organizer" value="{{ old('organizer') }}">
                            @error('organizer') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="location">Lokasi</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" name="location" id="location" value="{{ old('location') }}">
                            @error('location') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="table">Daftar Dosen</label>
                            <div id="lecturers-container">
                                @foreach(old('table', [['name' => '', 'nidn' => '', 'studyProgram' => '']]) as $index => $row)
                                <div class="row mb-1 table-<?= $index ?>">
                                    <div class="col">
                                        <input type="text" class="form-control @error('table.'.$index.'.name') is-invalid @enderror" name="table[{{ $index }}][name]" placeholder="Name" value="{{ $row['name'] }}">
                                        @error('table.'.$index.'.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control @error('table.'.$index.'.nidn') is-invalid @enderror" name="table[{{ $index }}][nidn]" placeholder="NIDN" value="{{ $row['nidn'] }}">
                                        @error('table.'.$index.'.nidn') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control @error('table.'.$index.'.studyProgram') is-invalid @enderror" name="table[{{ $index }}][studyProgram]" placeholder="Program Studi" value="{{ $row['studyProgram'] }}">
                                        @error('table.'.$index.'.studyProgram') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        @if($index == 0)
                                        <button class="btn btn-danger" type="button" disabled>Remove</button>
                                        @else
                                        <button class="btn btn-danger" type="button" onclick="removeLecturer(<?= $index ?>)">Remove</button>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-2 mb-3">
                                <button class="btn btn-primary" type="button" onclick="addLecturer()">Tambah dosen</button>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3 float-end">Submit</button>
                            </div>
                    </form>
                </div>

                <script>
                    let lecturerIndex = 1;

                    function addLecturer() {
                        const container = document.getElementById('lecturers-container');
                        const newRow = document.createElement('div');
                        newRow.className = `row mb-1 table-client-${lecturerIndex}`;
                        newRow.innerHTML = `
                                <div class="col">
                                    <input type="text" class="form-control" name="table[${lecturerIndex}][name]" placeholder="Name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="table[${lecturerIndex}][nidn]" placeholder="NIDN">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="table[${lecturerIndex}][studyProgram]" placeholder="Program Studi">
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger" type="button" onclick="removeLecturerClient(${lecturerIndex})">Remove</button>
                                </div>
                            `;
                        container.appendChild(newRow);
                        lecturerIndex++;
                    }

                    function removeLecturer(index) {
                        const container = document.getElementById('lecturers-container');
                        const row = document.querySelector(`.table-${index}`);
                        container.removeChild(row);
                    }

                    function removeLecturerClient(lecturerIndex) {
                        const container = document.getElementById('lecturers-container');
                        const row = document.querySelector(`.table-client-${lecturerIndex}`);
                        container.removeChild(row);
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection