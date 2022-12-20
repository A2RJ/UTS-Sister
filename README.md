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

-   Fungsi absen pulang sepertinya bermasalah ketika ada yang pulang dihari esok nya (security)
    --

## Tools

-   [Bootstrap form builder](https://startbootstrap.com/sb-form-builder)

## Tutorial

-   [Laravel permission](https://imansugirman.com/menggunakan-laravel-permission-dari-spatie)
    http://forum.centos-webpanel.com/index.php?topic=10177.0

STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION
