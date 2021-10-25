# Relasi
- Mengubah data bidang ilmu seorang SDM/ dari /referensi/kelompok_bidang dengan tipe IPTEK
- Ubah data bimbingan mahasiswa/ dari /referensi/kelompok_bidang  dengan tipe IPTEK
- Semua Bidang Ilmu pada modul relasi ke kelompok bidang (id_kelompok_bidang)

# Next Update
- Untuk data yg membutuhkan relasi, misalkan dokumen, jadikan otomatis dalam 1 fungsi saja, jadi hanya kirim params dengan tidak 2 fungsi yg dipanggil.
- Gunakan trait crud data
- Gunakan setter dan Getter, sehingga dapat menggunakan hanya 1 class tetapi untuk pemanggilan new ClassName(), dan set/get untuk mengambil data. jadi url dan fungsi jadi dinamis
- Gunakan $request->validate([]); atau Facade Validator