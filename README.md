# APP

## Sedang dikerjakan

-   [x] Laporan mata kuliah
-   [ ] jika ada attachment maka tampilkan pada tabel presensi
-   [ ] tampilkan tanggal jika telah izin
-   [x] jika telat maka wajib isi detail (opsional attachment - ANDROID)
-   [x] izin 1/2 hari
-   [x] izin 1 hari
-   [x] izin tidak masuk dengan alasan
-   [x] izin sakit
-   [ ] rekap tidak masuk (sakit, ijin keagamaan dan lain-lain)
-   [ ] batasai perhitungan jam kerja sampai jam 4
-   [x] berikan query permission = 1
-   [ ] pada menu civitas berikan detail struktural/posisi tiap civitas
-   [ ] berikan detail struktural per akun saat login (misal ka.prodi sipil dll)

## List testing

-   User

1. Staff

```
email: acuh.dharmawan.junaidi@uts.ac.id
password: 7700018335
```

2. Dosen

```
email: ahmad.juliansyah@uts.ac.id
password: 7700017859

email: i.made.widiarta@uts.ac.id
password: 0813018701
```

3. Prodi

```
email: i.made.widiarta@uts.ac.id
password: 0813018701
```

4. Fakultas

```
email: mietra.anggara@uts.ac.id
password: 0807039002
```

5. Dir Akdemik

```
email: abbyzar.aggasi@uts.ac.id
password: 0818019001
```

6. Dir SDM

```
email: ihwan.khuldi@uts.ac.id
password: 7700013494
```

## Databases

-   php artisan iseed human_resources,structures,structural_positions,classesy,subjects,meetings,presences
-   iseed before migrate:rollback
-   php artisan optimize:clear
-   php artisan config:clear

## Tools

-   [Bootstrap form builder](https://startbootstrap.com/sb-form-builder)

## Tutorial

-   [Laravel permission](https://imansugirman.com/menggunakan-laravel-permission-dari-spatie)
    http://forum.centos-webpanel.com/index.php?topic=10177.0

STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION

-   https://blog.devgenius.io/how-to-upgrade-from-laravel-9-x-to-laravel-10-x-926b826b454f

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
