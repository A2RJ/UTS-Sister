<div class="container px-5 my-5">
    <form>
        <div class="mb-3">
            <label class="form-label" for="mataKuliah">Mata kuliah</label>
            <input class="form-control" id="mataKuliah" type="text" placeholder="Mata kuliah" data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="mataKuliah:required">Mata kuliah is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="jumlahSks">Jumlah SKS</label>
            <input class="form-control" id="jumlahSks" type="text" placeholder="Jumlah SKS" data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="jumlahSks:required">Jumlah SKS is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="jumlahPertemuan">Jumlah pertemuan </label>
            <input class="form-control" id="jumlahPertemuan" type="text" placeholder="Jumlah pertemuan " data-sb-validations="required" />
            <div class="invalid-feedback" data-sb-feedback="jumlahPertemuan:required">Jumlah pertemuan is required.</div>
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