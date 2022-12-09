<div class="container px-5 my-5">
    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
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
            <label class="form-label" for="mataKuliah">Mata kuliah</label>
            <select class="form-select" id="mataKuliah" aria-label="Mata kuliah">
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
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>