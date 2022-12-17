-   iseed before migrate:rollback
-   php artisan optimize:clear
-   php artisan config:clear

# APP

-   faculty and study program is just home base detail in profile
-   structure is the main key for indexing supervisor and subordinate

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

## Progress

-   Sudah bisa dinamis set struktur
-   Sudah bisa login sebagai admin, rektor, fakultas, prodi,
-   Belum tampilkan children by parent
-   Belum get dosen by parent (menu fakultas dan prodi)
-   Notes:
    -- Khusus dir akademik -> lihat semua pengajaran dosen, assign fakultas (dekan) dan prodi (ka.prodi)  
    -- Khusus dsdm -> lihat semua kehadiran dosen dan human resources tp tidak bisa assign
    -- Khusus admin dapat semua
    -- (Optional) Khusus rektor -> hanya lihat sdm, structure, kehadiran dan pengajaran

## Sedang dikerjakan

-   mulai dari staff
-   lalu dosen
-   lalu prodi
-   lalu fakultas
-   lalu warek 1
-   lalu dddm

## Flowcart presensi kehadiran

-   civitas UTS Login
-   pilih presensi kehadiran (di Kampus)
-   pilih masuk -> POST
-   pilih pulang -> POST
-   selesai

## Boundary roles

-   User role
    -- Notes:
    -- Untuk pengembangan selanjutnya bisa subtitusi role diantara role yg sudah ada, misal wadek, sekretaris prodi dll. Jadi merubah parentId dari child

-   Roles
    -- Dosen dan Tendik diambil dari sister
    -- Setting manual siapa prodi, fakultas dan dir akademik (Opsi 1)
    -- Setting dinamis siapa prodi, fakultas dan dir akademik (Opsi 2)
    -- Tentunya akan berelasi antara fakultas, prodi, mata kuliah, kelas dan dosen

```
{
    'pengajaran': ['dosen', 'prodi', 'fakultas', 'direktorat akademik'],
    'kehadiran': ['civitas', 'dsdm', 'pimpinan'] // pimpinan = atasan masing-masing civitas UTS (struktural)
}
```

## Update

-   Setelah kelas selesai, generate link untuk mahasiswa untuk isi kehadiran dan data aduan mirip gform

```
{
    'field': ['subject_id', 'nim', 'nama', 'catatan:(bersifat sangat rahasia)']
}
```

-   absen 1x (hapus sebelumnya 2x)
-   filter by semester
-   filter between dates

## Tools

-   [Bootstrap form builder](https://startbootstrap.com/sb-form-builder)

## Tutorial

-   [Laravel permission](https://imansugirman.com/menggunakan-laravel-permission-dari-spatie)
