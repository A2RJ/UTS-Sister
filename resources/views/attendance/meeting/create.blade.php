<div class="container px-5 my-5">
    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
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
            <input class="form-control" id="fotoMulaiKelas" type="text" placeholder="Foto mulai kelas" data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="fotoMulaiKelas:required">Foto mulai kelas is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="fotoSelesaiKelas">Foto selesai kelas</label>
            <input class="form-control" id="fotoSelesaiKelas" type="text" placeholder="Foto selesai kelas" data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="fotoSelesaiKelas:required">Foto selesai kelas is required.</div>
        </div>
        <div class="d-none" id="submitSuccessMessage">
            <div class="text-center mb-3">
                <div class="fw-bolder">Form submission successful!</div>
                <p>To activate this form, sign up at</p>
                <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
            </div>
        </div>
        <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3">Error sending message!</div>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button>
        </div>
    </form>
</div>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>