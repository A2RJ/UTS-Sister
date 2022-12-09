<div class="container px-5 my-5">
    <form>
        <div class="mb-3">
            <label class="form-label" for="mataKuliah">Mata kuliah</label>
            <select class="form-select" id="mataKuliah" aria-label="Mata kuliah">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="kelas">Kelas</label>
            <select class="form-select" id="kelas" aria-label="Kelas">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="pertemuanKeHariDanTanggal">Pertemuan ke (hari dan tanggal)</label>
            <select class="form-select" id="pertemuanKeHariDanTanggal" aria-label="Pertemuan ke (hari dan tanggal)">
                <option value="1 - Senin 12 oktober 2022">1 - Senin 12 oktober 2022</option>
                <option value="2 - Selasa 17 oktober 2022">2 - Selasa 17 oktober 2022</option>
                <option value="3 - Rabu 25 oktober 2022">3 - Rabu 25 oktober 2022</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="fotoMulaiKelas">Foto mulai kelas</label>
            <input class="form-control" id="fotoMulaiKelas" type="text" placeholder="Foto mulai kelas" required />
            <div class="invalid-feedback">Foto mulai kelas is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="fotoSelesaiKelas">Foto selesai kelas</label>
            <input class="form-control" id="fotoSelesaiKelas" type="text" placeholder="Foto selesai kelas" required />
            <div class="invalid-feedback">Foto selesai kelas is required.</div>
        </div>
    </form>
</div>