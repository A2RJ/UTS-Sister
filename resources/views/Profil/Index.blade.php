@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="container">
        <div class="profil">
            <b>Profil</b>
            <p>nidn: {{ $kepegawaian['nidn'] }}</p>
            <p>nama: {{ $profil['nama'] }} </p>
            <p>jenis kelamin: {{ $profil['jenis_kelamin'] }} </p>
            <p>tempat lahir: {{ $profil['tempat_lahir'] }} </p>
            <p>tanggal lahir: {{ $profil['tanggal_lahir'] }} </p>
        </div>
        <div class="kependudukan">
            <b>kependudukan</b>
            <p>NIK: {{ $kependudukan['nik'] }}</p>
            <p>agama: {{ $kependudukan['agama'] }}</p>
            <p>kewarganegaraan: {{ $kependudukan['kewarganegaraan'] }}</p>
        </div>
        <div class="keluarga">
            <b>keluarga</b>
            <p>Status perkawinan: {{ $keluarga['id_status_kawin'] }} </p>
            <p>Nama suami/istri: {{ $keluarga['nama_pasangan'] }}</p>
            <p>NIP Suami/Istri: {{ $keluarga['nip_pasangan'] }}</p>
            <p>Pekerjaan Suami/Istri: {{ $keluarga['pekerjaan_pasangan'] }}</p>
            <p>Terhitung mulai tanggal pns suami/istri: <b>Tidak ada data dari API</b></p>
        </div>
        <div class="bidang_ilmu">
            <b>Bidang kelimuan</b>
            <ul>
                @foreach ($bidang_ilmu as $listIlmu)
                    <li>{{ $loop->iteration }} - {{ $listIlmu['kelompok_bidang'] }}</li>
                @endforeach
            </ul>
        </div>
        <div class="alamat">
            <b>alamat</b>
            <p>Email: {{ $alamat['email'] }}</p>
            <p>Alamat: {{ $alamat['alamat'] }}</p>
            <p>RT: {{ $alamat['rt'] }}</p>
            <p>RW: {{ $alamat['rw'] }}</p>
            <p>Dusun: {{ $alamat['dusun'] }}</p>
            <p>Desa/Kelurahan: {{ $alamat['kelurahan'] }}</p>
            <p>Kota/Kabupaten: {{ $alamat['kota_kabupaten'] }}</p>
            <p>Provinsi: <b>Get dari API</b></p>
            <p>Kode pos: {{ $alamat['kode_pos'] }}</p>
            <p>No. Telepon rumah: {{ $alamat['telepon_rumah'] }}</p>
            <p>No. hp: {{ $alamat['telepon_hp'] }}</p>
        </div>
        <div class="kepegawaian">
            <b>Kepegawaian</b>
            <p>Program studi: {{ $kepegawaian['unit_kerja'] }}</p>
            <p>NIP (Khusus PNS): {{ $kepegawaian['nip'] }}</p>
            <p>Status kepegawaian: {{ $kepegawaian['status_kepegawaian'] }}</p>
            <p>Status Keaktifan: {{ $kepegawaian['tanggal_keluar'] == false ? 'aktif' : $kepegawaian['tanggal_keluar'] }}
            </p>
            <p>Nomor SK CPNS: {{ $kepegawaian['sk_cpns'] }} </p>
            <p>SK CPNS Terhitung Mulai Tanggal: {{ $kepegawaian['tanggal_sk_cpns'] }} </p>
            <p>Nomor SK TMMD: {{ $kepegawaian['sk_tmmd'] }}</p>
            <p>Tanggal Mulai Menjadi Dosen (TMMD): {{ $kepegawaian['tmmd'] }} </p>
            <p>Pangkat/Golongan: <b>Tidak ada data / check API docs</b></p>
            <p>Sumber Gaji: {{ $kepegawaian['sumber_gaji'] }}</p>
        </div>
        <div class="lain-lain">
            <b>Lain-lain</b>
            <p>NPWP: {{ $lain['npwp'] }}</p>
            <p>Nama Wajib Pajak: {{ $lain['nama_wp'] }}</p>
            <p>SINTA ID: <b>Tidak tersedia</b></p>
        </div>
    </div>
@endsection
