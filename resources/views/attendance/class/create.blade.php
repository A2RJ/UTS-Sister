<div class="container px-5 my-5">
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label" for="programStudi">Program studi</label>
            <input class="form-control" id="programStudi" type="text" placeholder="Program studi" required />
            <div class="invalid-feedback" data-sb-feedback="programStudi:required">Program studi is required.</div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="kelas">Kelas</label>
            <input class="form-control" id="kelas" type="text" placeholder="Kelas" required />
            <div class="invalid-feedback" data-sb-feedback="kelas:required">Kelas is required.</div>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
        </div>
    </form>
</div>