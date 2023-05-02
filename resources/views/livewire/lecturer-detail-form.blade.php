<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <form wire:submit.prevent="submit">
        <h3 class="mb-3">Biodata Dosen</h3>
        <div class="form-group mb-2">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" value="{{ $user->sdm_name }}" readonly>
        </div>

        <div class="form-group mb-2">
            <label for="nidn">NIDN</label>
            <input type="text" class="form-control" id="nidn" value="{{ $user->nidn }}" readonly>
        </div>

        <div class="form-group mb-2">
            <label for="faculty">Fakultas</label>
            <select wire:model="faculty" class="form-control" id="faculty">
                <option value="">-- Pilih Fakultas --</option>
                @foreach ($faculties as $faculty)
                <option value="{{ $faculty->id }}">{{ $faculty->faculty }}</option>
                @endforeach
            </select>
            @error('faculty') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="study_program">Program Studi</label>
            <select wire:model="study_program" class="form-control" id="study_program">
                <option value="">-- Pilih Program Studi --</option>
                @if ($study_programs)
                @foreach ($study_programs as $program)
                <option value="{{ $program->id }}">{{ $program->study_program }}</option>
                @endforeach
                @endif
            </select>
            @error('study_program') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="expertise">Bidang Keahlian</label>
            <input wire:model.defer="expertise" type="text" class="form-control" id="expertise">
            @error('expertise') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-2">
            <label for="email">Alamat Email</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>

        <h3 class="mb-3 mt-4">Tema Riset</h3>
        <div class="form-group mb-2">
            <label>Tema Riset:</label>
            @foreach($themes as $key => $theme)
            <div style="margin-left: 20px;">
                <label>
                    <input type="radio" wire:model.lazy="theme" value="{{ $theme }}" wire:click="themeSelected">
                    {{ $theme }}
                </label>
            </div>
            @endforeach
            @error('theme') <span class="error text-danger">{{ $message }}</span> @enderror

            <div>
                @if($showOtherTheme == 'Lain-lain')
                <div class="form-group mb-2">
                    <label for="other-theme">Isikan Tema Lainnya:</label>
                    <input wire:model="other_theme" type="text" class="form-control" id="other-theme">
                </div>
                @endif
            </div>
            @error('other_theme') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3 float-end">Submit data</button>
        </div>
    </form>
</div>