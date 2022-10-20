@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card">
        <div class="row">
            <div class="col-sm-6">
                <b>Profil</b>
                <table>
                    <tr>
                        <td>NIDN</td>
                        <td>: {{ $kepegawaian['nidn'] }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: {{ $profil['nama'] }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: {{ $profil['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>: {{ $profil['tempat_lahir'] }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>: {{ \Carbon\Carbon::parse($profil['tanggal_lahir'])->isoFormat('Do MMMM YYYY') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <b>kependudukan</b>
                <table>
                    <tr>
                        <td>NIK</td>
                        <td>: {{ $kependudukan['nik'] }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>: {{ $kependudukan['agama'] }}</td>
                    </tr>
                    <tr>
                        <td>Kewarganegaraan</td>
                        <td>: {{ $kependudukan['kewarganegaraan'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <b>keluarga</b>
                <table>
                    <tr>
                        <td>Status Perkawinan</td>
                        <td>: {{ $keluarga['id_status_kawin'] }}</td>
                    </tr>
                    <tr>
                        <td>Nama Suami/Istri</td>
                        <td>: {{ $keluarga['nama_pasangan'] }}</td>
                    </tr>
                    <tr>
                        <td>NIP Suami/Istri</td>
                        <td>: {{ $keluarga['nip_pasangan'] ? $keluarga['nip_pasangan'] : 'Tidak ada' }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan Suami/Istri</td>
                        <td>: {{ $keluarga['pekerjaan_pasangan'] }}</td>
                    </tr>
                    <tr>
                        <td>Terhitung Mulai Tanggal PNS Suami/Istri</td>
                        <td>: <b>Data tidak ada di API</b></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <b>Bidang kelimuan</b>
                <ul>
                    @foreach ($bidang_ilmu as $listIlmu)
                        <li>{{ $listIlmu['kelompok_bidang'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-6">
                <b>alamat</b>
                <table>
                    <tr>
                        <td>Email</td>
                        <td>: {{ $alamat['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ $alamat['alamat'] }}</td>
                    </tr>
                    <tr>
                        <td>RT</td>
                        <td>: {{ $alamat['rt'] }}</td>
                    </tr>
                    <tr>
                        <td>RW</td>
                        <td>: {{ $alamat['rw'] }}</td>
                    </tr>
                    <tr>
                        <td>Dusun</td>
                        <td>: {{ $alamat['dusun'] }}</td>
                    </tr>
                    <tr>
                        <td>Desa/Kelurahan</td>
                        <td>: {{ $alamat['kelurahan'] }}</td>
                    </tr>
                    <tr>
                        <td>Kota/Kabupaten</td>
                        <td>: {{ $alamat['kota_kabupaten'] }}</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>: <b>Get dari API</b></td>
                    </tr>
                    <tr>
                        <td>Kode pos</td>
                        <td>: {{ $alamat['kode_pos'] }}</td>
                    </tr>
                    <tr>
                        <td>No. Telepon rumah</td>
                        <td>: {{ $alamat['telepon_rumah'] }}</td>
                    </tr>
                    <tr>
                        <td>No. hp</td>
                        <td>: {{ $alamat['telepon_hp'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <b>Kepegawaian</b>
                <table>
                    <tr>
                        <td>Program studi</td>
                        <td>: {{ $kepegawaian['unit_kerja'] }}</td>
                    </tr>
                    <tr>
                        <td>NIP (Khusus PNS)</td>
                        <td>: {{ $kepegawaian['nip'] }}</td>
                    </tr>
                    <tr>
                        <td>Status kepegawaian</td>
                        <td>: {{ $kepegawaian['status_kepegawaian'] }}</td>
                    <tr>
                        <td>Status Keaktifan</td>
                        <td>: {{ $kepegawaian['tanggal_keluar'] == false ? 'aktif' : $kepegawaian['tanggal_keluar'] }}</td>
                    </tr>
                    <tr>
                        <td>Nomor SK CPNS</td>
                        <td>: {{ $kepegawaian['sk_cpns'] }} </td>
                    </tr>
                    <tr>
                        <td>SK CPNS Terhitung Mulai Tanggal</td>
                        <td>: {{ $kepegawaian['tanggal_sk_cpns'] }} </td>
                    </tr>
                    <tr>
                        <td>Nomor SK TMMD</td>
                        <td>: {{ $kepegawaian['sk_tmmd'] }}</td>
                    <tr>
                        <td>Tanggal Mulai Menjadi Dosen (TMMD)</td>
                        <td>: {{ $kepegawaian['tmmd'] }} </td>
                        <p>Pangkat/Golongan: <b>Tidak ada data / check API docs</b></p>
                    </tr>
                    <tr>
                        <td>Sumber Gaji</td>
                        <td>: {{ $kepegawaian['sumber_gaji'] }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <b>Lain-lain</b>
                <table>
                    <tr>
                        <td>NPWP</td>
                        <td>: {{ $lain['npwp'] }}</td>
                    </tr>
                    <tr>
                        <td>Nama Wajib Pajak</td>
                        <td>: {{ $lain['nama_wp'] }}</td>
                    </tr>
                    <tr>
                        <td>SINTA ID</td>
                        <td>: <b>Tidak tersedia</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
