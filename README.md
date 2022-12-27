# APP

-   iseed before migrate:rollback
-   php artisan optimize:clear
-   php artisan config:clear

## Flowcart presensi pengajaran

-   Dosen
    -- login
    -- pilih presensi pengajaran
    -- pilih mata kuliah
    -- pilih kelas
    -- pilih pertemuan ke-n
    -- lalu input foto mulai
    -- lalu share link feedback ke mahasiswa sbg absensi kehadiran
    -- selesai
    -- menampilkan jumlah pengajaran selesai dan belum, nilai SKS per ata kuliah

-   Prodi
    -- check structure, jika user === prodi, maka sub === get dosen by parentsama dan type === dosen
    -- jadwal Perkuliahan -> input mata kuliah -> atur jam pertemuan
    -- menampilkan list dosen -> klik detail
    --- menampilkan jumlah pengajaran selesai dan belum, nilai SKS per ata kuliah

-   Fakultas
    -- menampilkan list dosen -> klik detail
    --- menampilkan jumlah pengajaran selesai dan belum, nilai SKS per ata kuliah

-   Direktorat Akademik
    -- menampilkan list dosen -> klik detail
    --- menampilkan jumlah pengajaran selesai dan belum, nilai SKS per ata kuliah

-   Admin
    -- menampilkan list dosen -> klik detail
    --- menampilkan jumlah pengajaran selesai dan belum, nilai SKS per ata kuliah
    -- dan lain-lain

-   Notes:
    -- Struktur BKD ini berbeda dengan struktur dinamis yang akan diterapkan selanjutnya

## Sedang dikerjakan

-   Laporan mata kuliah

## Flowcart presensi kehadiran

-   civitas UTS Login
-   pilih presensi kehadiran (di Kampus)
-   pilih masuk -> POST
-   pilih pulang -> POST
-   selesai

## Boundary roles

```
{
    'pengajaran': ['dosen', 'prodi', 'fakultas', 'direktorat akademik'],
    'kehadiran': ['civitas', 'dsdm', 'pimpinan'] // pimpinan = atasan masing-masing civitas UTS (struktural)
}
```

## Databases

-   php artisan iseed human_resources,structures,structural_positions,classesy,subjects,meetings,presences

## Urgent

-   ## Fungsi absen pulang sepertinya bermasalah ketika ada yang pulang dihari esok nya (security)

## Tools

-   [Bootstrap form builder](https://startbootstrap.com/sb-form-builder)

## Tutorial

-   [Laravel permission](https://imansugirman.com/menggunakan-laravel-permission-dari-spatie)
    http://forum.centos-webpanel.com/index.php?topic=10177.0

STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION

Berikut adalah beberapa contoh laporan yang bisa Anda buat hanya berdasarkan data pengajaran dosen dan kehadiran di kampus:

Laporan absen pengajaran dosen: Laporan ini menyertakan data tentang jumlah jam yang telah diajar oleh setiap dosen, termasuk tanggal, waktu, dan mata kuliah yang diajarkan. Anda juga bisa menambahkan informasi seperti jumlah jam yang diakui oleh universitas atau institusi tempat Anda bekerja.

Laporan absen kehadiran dosen: Laporan ini menyertakan data tentang kehadiran dosen pada setiap sesi atau kegiatan pengajaran, termasuk tanggal, waktu, dan lokasi kegiatan. Anda juga bisa menambahkan keterangan tambahan seperti alasan tidak hadir atau jumlah jam yang dihadiri.

Laporan absen kehadiran siswa: Laporan ini menyertakan data tentang kehadiran siswa pada setiap sesi atau kegiatan pengajaran, termasuk tanggal, waktu, dan lokasi kegiatan. Anda juga bisa menambahkan keterangan tambahan seperti alasan tidak hadir atau jumlah jam yang dihadiri.

Laporan pemakaian ruangan: Laporan ini menyertakan data tentang pemakaian ruangan untuk kegiatan pengajaran, termasuk tanggal, waktu, dan jenis kegiatan yang dilakukan.

Laporan evaluasi dosen: Laporan ini menyertakan hasil evaluasi dosen oleh siswa atau kolega, termasuk data tentang kualitas pengajaran, kemampuan menyampaikan materi, dan kemampuan mengelola kelas.

Laporan kinerja dosen: Laporan ini menyertakan data tentang kinerja dosen, termasuk jumlah jam yang diajar, jumlah siswa yang terdaftar dalam kelas yang diajar, dan hasil evaluasi dosen oleh siswa atau kolega.

Laporan kinerja siswa: Laporan ini menyertakan data tentang kinerja siswa, termasuk nilai ujian, tugas, dan proyek, serta kehadiran pada sesi pengajaran.

Laporan keuangan pengajaran: Laporan ini menyertakan data tentang pengeluaran dan pendapatan yang terkait dengan kegiatan pengajaran, termasuk biaya ruangan, honorarium dosen, dan biaya lainnya.

## TIPS

-   Validasi valid URL from server (bukan ketikan)

```
return URL::temporarySignedRoute(
    'download.sub-lecturer',
    now()->addMinutes(5),
    ['query', request()->getQueryString()]
);
use Illuminate\Support\Facades\URL;

if (URL::hasValidSignature($request)) {
  // URL asli dan belum kadaluarsa
} else {
  // URL tidak asli atau telah kadaluarsa
}
```
