<div class="container px-5 my-5">
    <form>
        <div class="mb-3">
            <label class="form-label" for="mataKuliah">Mata kuliah</label>
            <input class="form-control" id="mataKuliah" type="text" placeholder="Mata kuliah" required />
            <div class="invalid-feedback">Mata kuliah is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="jumlahSks">Jumlah SKS</label>
            <input class="form-control" id="jumlahSks" type="text" placeholder="Jumlah SKS" required />
            <div class="invalid-feedback">Jumlah SKS is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="jumlahPertemuan">Jumlah pertemuan </label>
            <input class="form-control" id="jumlahPertemuan" type="text" placeholder="Jumlah pertemuan " required />
            <div class="invalid-feedback">Jumlah pertemuan is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="programStudi">Program studi</label>
            <select class="form-select" id="programStudi" aria-label="Program studi">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="pilihDosen">Pilih dosen</label>
            <select class="form-select" id="pilihDosen" aria-label="Pilih dosen">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

    </form>
</div>