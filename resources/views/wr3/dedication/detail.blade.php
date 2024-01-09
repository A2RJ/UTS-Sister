@extends('layouts.dashboard')
@section('title', 'Detail Pengabdian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Detail pengabdian</div>

                <div class="card-body">
                    <form action="" method="POST">
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
                            <input type="text" class="form-control @error('role') is-invalid @enderror" name="role" id="role" value="{{ old('role', $dedication->role) }}">
                            @error('role') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="as">Sebagai</label>
                            <input type="text" class="form-control @error('as') is-invalid @enderror" name="as" id="as" value="{{ old('as', $dedication->as) }}">
                            @error('as') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="theme">Tema</label>
                            <input type="text" class="form-control @error('theme') is-invalid @enderror" name="theme" id="theme" value="{{ old('theme', $dedication->theme) }}">
                            @error('theme') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="title">Judul pengabdian:</label>
                            <input type="text" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title', $dedication->title) }}">
                            @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="funding_source">Sumber Pendanaan:</label>
                            <input type="text" id="funding_source" class="form-control{{ $errors->has('funding_source') ? ' is-invalid' : '' }}" name="funding_source" value="{{ old('funding_source', $dedication->funding_source) }}">
                            @error('funding_source') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="funding_amount">Jumlah Pendanaan:</label>
                            <input type="number" id="funding_amount" class="form-control{{ $errors->has('funding_amount') ? ' is-invalid' : '' }}" name="funding_amount" value="{{ old('funding_amount', $dedication->funding_amount) }}">
                            @error('funding_amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="proposal_file">Proposal File:</label>
                            <input type="file" id="proposal_file" class="form-control{{ $errors->has('proposal_file') ? ' is-invalid' : '' }}" name="proposal_file">
                            @error('proposal_file') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="report_file">Laporan Pengabdian (Opsional: Diisi jika pengabdian telah selesai):</label>
                            <input type="file" id="report_file" class="form-control{{ $errors->has('report_file') ? ' is-invalid' : '' }}" name="report_file">
                            @error('report_file') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" id="start_date" class="form-control{{ $errors->has('start_date') ? ' is-invalid' : '' }}" name="start_date" value="{{ old('start_date', $dedication->start_date) }}">
                            @error('start_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="end_date">Tanggal Selesai (Opsional):</label>
                            <input type="date" id="end_date" class="form-control{{ $errors->has('end_date') ? ' is-invalid' : '' }}" name="end_date" value="{{ old('end_date', $dedication->end_date) }}">
                            @error('end_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="location">Tempat:</label>
                            <input type="text" id="location" class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" value="{{ old('location', $dedication->location) }}">
                            @error('location') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="participants">Daftar Anggota</label>
                            <div id="lecturers-container">
                                @foreach(old('participants', json_decode($dedication->participants, true), [['name' => '', 'nidn' => '', 'studyProgram' => '', 'detail' => '']]) as $index => $row)
                                <div class="row mb-1 participants-<?= $index ?>">
                                    <div class="col">
                                        <input type="text" class="form-control @error('participants.'.$index.'.name') is-invalid @enderror" name="participants[{{ $index }}][name]" placeholder="Name" value="{{ $row['name'] }}">
                                        @error('participants.'.$index.'.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control @error('participants.'.$index.'.nidn') is-invalid @enderror" name="participants[{{ $index }}][nidn]" placeholder="NIDN" value="{{ $row['nidn'] }}">
                                        @error('participants.'.$index.'.nidn') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control @error('participants.'.$index.'.studyProgram') is-invalid @enderror" name="participants[{{ $index }}][studyProgram]" placeholder="Program Studi" value="{{ $row['studyProgram'] }}">
                                        @error('participants.'.$index.'.studyProgram') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control @error('participants.'.$index.'.detail') is-invalid @enderror" name="participants[{{ $index }}][detail]" placeholder="Detail" value="{{ $row['detail'] }}">
                                        @error('participants.'.$index.'.detail') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
                        </div>

                        <div class="form-group mb-2">
                            <label for="target_activity_outputs">Target Luaran Kegiatan:</label>
                            <textarea id="target_activity_outputs" class="form-control{{ $errors->has('target_activity_outputs') ? ' is-invalid' : '' }}" name="target_activity_outputs" rows="4">{{ old('target_activity_outputs', $dedication->target_activity_outputs) }}</textarea>
                            @error('target_activity_outputs') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="public_media_publications">Luaran Publikasi Media Masa:</label>
                            <textarea id="public_media_publications" class="form-control{{ $errors->has('public_media_publications') ? ' is-invalid' : '' }}" name="public_media_publications" rows="4">{{ old('public_media_publications', $dedication->public_media_publications) }}</textarea>
                            @error('public_media_publications') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="scientific_publications">Luaran Publikasi Ilmiah:</label>
                            <textarea id="scientific_publications" class="form-control{{ $errors->has('scientific_publications') ? ' is-invalid' : '' }}" name="scientific_publications" rows="4">{{ old('scientific_publications', $dedication->scientific_publications) }}</textarea>
                            @error('scientific_publications') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let lecturerIndex = 1;

    function addLecturer() {
        const container = document.getElementById('lecturers-container');
        const newRow = document.createElement('div');
        newRow.className = `row mb-1 participants-client-${lecturerIndex}`;
        newRow.innerHTML = `
                                <div class="col">
                                    <input type="text" class="form-control" name="participants[${lecturerIndex}][name]" placeholder="Name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="participants[${lecturerIndex}][nidn]" placeholder="NIDN">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="participants[${lecturerIndex}][studyProgram]" placeholder="Program Studi">
                                </div>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="participants[${lecturerIndex}][detail]" placeholder="Detail">
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
        const row = document.querySelector(`.participants-${index}`);
        container.removeChild(row);
    }

    function removeLecturerClient(lecturerIndex) {
        const container = document.getElementById('lecturers-container');
        const row = document.querySelector(`.participants-client-${lecturerIndex}`);
        container.removeChild(row);
    }
</script>
@endsection