 <div>
     @if (session()->has('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
     @endif

     <form wire:submit.prevent="submit">
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
             <input type="text" class="form-control @error('role') is-invalid @enderror" wire:model="role" id="role">
             @error('role') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class="form-group mb-3">
             <label for="activity">Kegiatan</label>
             <input type="text" class="form-control @error('activity') is-invalid @enderror" wire:model="activity" id="activity">
             @error('activity') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class="form-group mb-3">
             <label for="as">Sebagai</label>
             <input type="text" class="form-control @error('as') is-invalid @enderror" wire:model="as" id="as">
             @error('as') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class="form-group mb-3">
             <label for="theme">Tema</label>
             <input type="text" class="form-control @error('theme') is-invalid @enderror" wire:model="theme" id="theme">
             @error('theme') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class="form-group mb-3">
             <label for="dateStart">Mulai Tanggal</label>
             <input type="date" class="form-control @error('dateStart') is-invalid @enderror" wire:model="dateStart" id="dateStart">
             @error('dateStart') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class="form-group mb-3">
             <label for="dateEnd">Selesai Tanggal (Opsional)</label>
             <input type="date" class="form-control @error('dateEnd') is-invalid @enderror" wire:model="dateEnd" id="dateEnd">
             @error('dateEnd') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class="form-group mb-3">
             <label for="organizer">Penyelenggara</label>
             <input type="text" class="form-control @error('organizer') is-invalid @enderror" wire:model="organizer" id="organizer">
             @error('organizer') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class="form-group mb-3">
             <label for="location">Lokasi</label>
             <input type="text" class="form-control @error('location') is-invalid @enderror" wire:model="location" id="location">
             @error('location') <span class="invalid-feedback">{{ $message }}</span> @enderror
         </div>

         <div class=" form-group mb-3">
             <label for="table">Daftar Dosen</label>
             @foreach ($table as $index => $row)
             <div class="row">
                 <div class="col">
                     <input type="text" class="form-control @error('table.'.$index.'.name') is-invalid @enderror" wire:model="table.{{ $index }}.name" placeholder="Name">
                     @error('table.'.$index.'.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                 </div>
                 <div class="col">
                     <input type="text" class="form-control @error('table.'.$index.'.nidn') is-invalid @enderror" wire:model="table.{{ $index }}.nidn" placeholder="NIDN">
                     @error('table.'.$index.'.nidn') <span class="invalid-feedback">{{ $message }}</span> @enderror
                 </div>
                 <div class="col">
                     <input type="text" class="form-control @error('table.'.$index.'.studyProgram') is-invalid @enderror" wire:model="table.{{ $index }}.studyProgram" placeholder="program studi">
                     @error('table.'.$index.'.studyProgram') <span class="invalid-feedback">{{ $message }}</span> @enderror
                 </div>
                 <div class="col">
                     <button class="btn btn-danger" wire:click="removeTable({{ $index }})">Remove</button>
                 </div>
             </div>
             @endforeach
             <div class="mt-2 mb-3">
                 <button class="btn btn-primary" wire:click="addTable">Tambah dosen</button>
             </div>
         </div>

         <div class="d-flex justify-content-end">
             <button type="submit" class="btn btn-primary mt-3 float-end">Submit</button>
         </div>
     </form>
 </div>