@extends('layouts.dashboard')

@section('title', 'Detail SDM')

@section('content')
<div class="container p-5 card">
    <h4 class="mb-4">Detail {{ $humanResource->sdm_name }}</h4>

    <div class="mb-3">
        <label class="form-label" for="nama">Nama</label>
        <input class="form-control @error('sdm_name') is-invalid @enderror" id="nama" type="text" placeholder="Nama" value="{{ old('sdm_name') }}" />
        <div class="invalid-feedback">Nama is required.</div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nidn">NIDN</label>
        <input class="form-control" id="nidn" type="text" placeholder="NIDN" required />
        <div class="invalid-feedback">NIDN is required.</div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nip">NIP</label>
        <input class="form-control" id="nip" type="text" placeholder="NIP" required />
        <div class="invalid-feedback">NIP is required.</div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="status">Status</label>
        <select class="form-select" id="status" aria-label="Status">
            <option value="Aktif">Aktif</option>
            <option value="Tidak aktif">Tidak aktif</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="jenis">Jenis</label>
        <select class="form-select" id="jenis" aria-label="Jenis">
            <option value="Dosen">Dosen</option>
            <option value="Dosen (DT)">Dosen (DT)</option>
            <option value="Tenaga kependidikan">Tenaga kependidikan</option>
            <option value="Security">Security</option>
            <option value="Customer Service">Customer Service</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="terdaftarSister">Terdaftar sister</label>
        <select class="form-select" id="terdaftarSister" aria-label="Terdaftar sister">
            <option value="Terdaftar">Terdaftar</option>
            <option value="Tidak Terdaftar">Tidak Terdaftar</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="fakultas">Fakultas</label>
        <select class="form-select" id="fakultas" aria-label="Fakultas">
            <option value="Fakultas Rekaya Sistem">Fakultas Rekaya Sistem</option>
            <option value="Fakultas Teknobiologi dan Humaniora">Fakultas Teknobiologi dan Humaniora</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="programStudi">Program studi</label>
        <select class="form-select" id="programStudi" aria-label="Program studi">
            <option value="Informatika">Informatika</option>
            <option value="Teknik sipil">Teknik sipil</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="jabatanStruktural">Jabatan struktural</label>
        <select class="form-select" id="jabatanStruktural" aria-label="Jabatan struktural">
            <option value="Rektor">Rektor</option>
            <option value="Warek 1 Akademik">Warek 1 Akademik</option>
            <option value="Warek 2 Keuangan">Warek 2 Keuangan</option>
        </select>
    </div>
</div>
@endsection