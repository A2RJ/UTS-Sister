<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $meeting }}</div>

                    <div class="card-body">
                        <x-success-message />
                        <x-error-message />

                        <form method="POST" action="{{ route('presence.mahasiswa', $id) }}">
                            @csrf
                            <input type="hidden" name="url" value="{{ $url }}">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id=" floatingInputNama" name="nama" placeholder="Nama" value="{{ old('nama') }}" required>
                                <label for="floatingInputNama">Nama</label>
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="floatingInputNIM" name="nim" placeholder="NIM" value="{{ old('nim') }}" required>
                                <label for="floatingInputNIM">NIM</label>
                                @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <textarea class="form-control @error('komentar') is-invalid @enderror" placeholder="Leave a comment here" name="komentar" id="floatingTextarea" style="height: 100px" value="{{ old('komentar') }}"></textarea>
                                <label for="floatingTextarea">Kometar</label>
                                @error('komentar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-danger">*Komentar anda sangat rahasia</small>
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>