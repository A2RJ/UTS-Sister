<div>
    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="number">Number</label>
            <input type="text" class="form-control @error('number') is-invalid @enderror" wire:model="number" id="number">
            @error('number') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="month">Month</label>
            <input type="text" class="form-control @error('month') is-invalid @enderror" wire:model="month" id="month">
            @error('month') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" class="form-control @error('year') is-invalid @enderror" wire:model="year" id="year">
            @error('year') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" wire:model="status" id="status">
                <option value="">Pilih status</option>
                <option value="1">Konfirmasi</option>
                <option value="0">Tolak</option>
            </select>
            @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary mt-3 float-end">Submit</button>
        </div>
    </form>
</div>