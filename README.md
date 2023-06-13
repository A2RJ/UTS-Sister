# APP

- Sebelum kerjakan fitur tertentu buat saja branch dev-features-name agar dev tetap bersih sehingga gampang kembali ke branch dev features sebelumnya

## Sedang dikerjakan

- [X] Laporan mata kuliah
- [ ] jika ada attachment maka tampilkan pada tabel presensi
- [X] tampilkan tanggal jika telah izin
- [X] jika telat maka wajib isi detail (opsional attachment - ANDROID)
- [X] izin 1/2 hari
- [X] izin 1 hari
- [X] izin tidak masuk dengan alasan
- [X] izin sakit
- [ ] rekap tidak masuk (sakit, ijin keagamaan dan lain-lain)
- [X] batasai perhitungan jam kerja sampai jam 4
- [X] berikan query permission = 1
- [X] pada menu civitas berikan detail struktural/posisi tiap civitas
- [X] berikan detail struktural per akun saat login (misal ka.prodi sipil dll)
- [X] ubah user menu menjadi absensi menu dan hapus sub divisi menu
- [X] ubah menu absensi kehadiran
  - [ ] absensi saya, input izin dan list izin
  - [ ] absensi sub divisi - radio button per unit, per civitas, semua absensi, list izin sub divisi
- [X] fixing roles()
- [ ] Ubah pengecekan whereDate atau semua filter date karena check_in_time bisa berisi 2023-12-12, dan ubah carbon menggunakan format dmY saja

## List testing

- User

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

- php artisan iseed human_resources,structures,structural_positions,classesy,subjects,meetings,presences
- iseed before migrate:rollback
- php artisan optimize:clear
- php artisan config:clear

## Tools

- [Bootstrap form builder](https://startbootstrap.com/sb-form-builder)

## Tutorial

- [Laravel permission](https://imansugirman.com/menggunakan-laravel-permission-dari-spatie)
  http://forum.centos-webpanel.com/index.php?topic=10177.0

STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION

- https://blog.devgenius.io/how-to-upgrade-from-laravel-9-x-to-laravel-10-x-926b826b454f

## TIPS

- // https://kepegawaian.uts.ac.id/presence/per-unit/54?search=&start=&end=&filter=per-unit
- Validasi valid URL from server (bukan ketikan)

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
