@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Biodata Dosen') }}</div>

                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('rinov.post-data-dosen') }}">
                        @csrf

                        <h3 class="mb-3">Biodata Dosen</h3>
                        <div class="form-group mb-2">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->sdm_name }}" readonly>
                        </div>

                        <div class="form-group mb-2">
                            <label for="nidn">NIDN</label>
                            <input type="text" class="form-control" id="nidn" name="nidn" value="{{ $user->nidn }}" readonly>
                        </div>

                        <div class="form-group mb-2">
                            <label for="faculty">Fakultas</label>
                            <select name="faculty" class="form-control" id="faculty" onchange="fetchStudyPrograms">
                                <option value="">-- Pilih Fakultas --</option>
                                @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}" @if($detail?->faculty_id == $faculty->id) selected @endif
                                    >{{ ucwords($faculty->faculty) }}</option>
                                @endforeach
                            </select>
                            @error('faculty') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="study_program">Program Studi</label>
                            <select name="study_program" class="form-control" id="study_program">
                                <option value="">-- Pilih Program Studi --</option>
                            </select>
                            @error('study_program') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="expertise">Bidang Keahlian</label>
                            <input type="text" class="form-control" id="expertise" name="expertise" value="{{ old('expertise', $detail?->expertise ?? '') }}">
                            @error('expertise') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="email">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                        </div>

                        <h3 class="mb-3 mt-4">Tema Riset</h3>
                        <div class="form-group mb-2">
                            <label>Tema Riset:</label>
                            @foreach($themes as $key => $theme)
                            <div style="margin-left: 20px;">
                                <label>
                                    <input type="radio" name="theme" value="{{ $theme }}" @if(old('theme', $detail?->theme ?? '')==$theme) checked @endif>
                                    {{ $theme }}
                                </label>
                            </div>
                            @endforeach
                            @error('theme') <span class="error text-danger">{{ $message }}</span> @enderror

                            <div class="form-group mb-2">
                                <label for="other-theme">Isikan Tema Lainnya:</label>
                                <input type="text" class="form-control" id="other-theme" name="other_theme" value="{{ $detail?->other_theme }}">
                            </div>
                            @error('other_theme') <span class="error text-danger">{{ $message }}</span> @enderror
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
    function fetchStudyPrograms() {
        var facultySelect = document.getElementById('faculty');
        var studyProgramSelect = document.getElementById('study_program');
        var selectedFaculty = facultySelect.value;

        if (!selectedFaculty) {
            studyProgramSelect.innerHTML = '';
            return;
        }

        studyProgramSelect.innerHTML = '<option value="">Loading...</option>';

        fetch('/warek-iii/study-program/' + selectedFaculty)
            .then(response => response.json())
            .then(data => {
                studyProgramSelect.innerHTML = '';

                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = '-- Pilih Program Studi --';
                studyProgramSelect.appendChild(defaultOption);

                data.forEach(function(program) {
                    var option = document.createElement('option');
                    option.value = program.id;
                    option.textContent = ucwords(program.study_program);

                    // Tandai opsi yang dipilih jika sesuai dengan $detail->study_program_id
                    if ('{{ $detail?->study_program_id }}' == program.id) {
                        option.setAttribute('selected', 'selected');
                    }

                    studyProgramSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error(error);
                studyProgramSelect.innerHTML = '<option value="">Failed to fetch data</option>';
            });
    }

    // Panggil fungsi fetchStudyPrograms saat halaman dimuat
    window.addEventListener('DOMContentLoaded', fetchStudyPrograms);

    // Tambahkan event listener untuk perubahan fakultas
    var facultySelect = document.getElementById('faculty');
    facultySelect.addEventListener('change', fetchStudyPrograms);

    function ucwords(str) {
        return str.toLowerCase().replace(/^(.)|\s+(.)/g, function($1) {
            return $1.toUpperCase();
        });
    }

    // Mendapatkan elemen-elemen yang diperlukan
    var themeRadios = document.querySelectorAll('input[name="theme"]');
    var otherThemeInput = document.getElementById('other-theme');

    // Mendaftarkan event listener untuk perubahan pada radio button tema
    themeRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.value === 'Lain-lain') {
                otherThemeInput.removeAttribute('disabled');
                otherThemeInput.value = '{{ $detail?->other_theme }}';
            } else {
                otherThemeInput.setAttribute('disabled', 'disabled');
                otherThemeInput.value = '';
            }
        });
    });

    // Memeriksa nilai radio button tema saat halaman dimuat
    themeRadios.forEach(function(radio) {
        if (radio.checked && radio.value === 'Lain-lain') {
            otherThemeInput.removeAttribute('disabled');
            otherThemeInput.value = '{{ $detail?->other_theme }}';
        } else {
            otherThemeInput.setAttribute('disabled', 'disabled');
            otherThemeInput.value = '';
        }
    });
</script>

@endsection