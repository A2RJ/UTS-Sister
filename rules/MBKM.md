# Endpoints

-   get token

POST https://kepegawaian.uts.ac.id/api/auth/token

Headers

```
Accept: application/json
Authorization: Bearer 7|Il0L7nxAezzwrlSAbV7y7c0HZva4DMnCQVBUg4q4

```

Response

```
{
  "data": {
    "access_token": "8|Xt0f6CbeRPrT2KytHUTyeysJfBijSLNPiVi7XQUb"
  }
}
```

-   get fakultas

GET https://kepegawaian.uts.ac.id/api/faculty

Headers

```
Accept: application/json
Authorization: Bearer 7|Il0L7nxAezzwrlSAbV7y7c0HZva4DMnCQVBUg4q4

```

Response

```
{
  "data": [
    {
      "id": 1,
      "faculty": "fakultas rekaya sistem"
    },
    {
      "id": 2,
      "faculty": "fakultas teknik lingkungan dan mineral"
    },
    ...
    {
      "id": 8,
      "faculty": "fakultas ilmu sosial dan politik"
    }
  ]
}
```

-   get prodi

GET https://kepegawaian.uts.ac.id/api/study-program

Headers

```
Accept: application/json
Authorization: Bearer 7|Il0L7nxAezzwrlSAbV7y7c0HZva4DMnCQVBUg4q4

```

Response

```
{
  "data": [
    {
      "id": 1,
      "faculty_id": 2,
      "study_program": "teknik metalurgi"
    },
    {
      "id": 2,
      "faculty_id": 1,
      "study_program": "teknik mesin"
    },
    ...
    {
      "id": 27,
      "faculty_id": 2,
      "study_program": "teknik pertambangan"
    }
  ]
}
```

-   get dosen

GET https://kepegawaian.uts.ac.id/api/lecture

Headers

```
Accept: application/json
Authorization: Bearer 7|Il0L7nxAezzwrlSAbV7y7c0HZva4DMnCQVBUg4q4

```

Response

```
{
  "data": [
        {
        "id": 5,
        "sdm_id": "b27d3846-f8c2-470b-9b64-bd2dab5e8db4",
        "sdm_name": "ABBYZAR AGGASI",
        "email": "abbyzar.aggasi@uts.ac.id",
        "email_verified_at": null,
        "nidn": "0818019001",
        "nip": "",
        "active_status_name": "Aktif",
        "employee_status": "NON PNS",
        "sdm_type": "Dosen",
        "is_sister_exist": 1,
        "created_at": "2022-12-10T12:45:41.000000Z",
        "updated_at": "2023-01-15T11:37:54.000000Z",
        "program_studi_id": 8,
        "faculty_id": 5,
        "study_program": "teknologi hasil pertanian",
        "faculty": "fakultas teknologi pertanian"
        },
        {
        "id": 2,
        "sdm_id": "4733ea8c-86d1-4b31-bb3c-81ccc7790a3a",
        "sdm_name": "ABDUL HADI ILMAN",
        "email": "abdul.hadi.ilman@uts.ac.id",
        "email_verified_at": null,
        "nidn": "0830088701",
        "nip": "",
        "active_status_name": "TUGAS BELAJAR",
        "employee_status": "NON PNS",
        "sdm_type": "Dosen",
        "is_sister_exist": 1,
        "created_at": "2022-12-10T12:45:41.000000Z",
        "updated_at": "2023-01-15T11:37:54.000000Z",
        "program_studi_id": 12,
        "faculty_id": 2,
        "study_program": "teknik elektro",
        "faculty": "fakultas teknik lingkungan dan mineral"
        },
        ...
        {
        "id": 6,
        "sdm_id": "c27990b7-4950-4457-bcac-2b49a986dfd7",
        "sdm_name": "ABDUL SALAM",
        "email": "abdul.salam@uts.ac.id",
        "email_verified_at": null,
        "nidn": "0802128602",
        "nip": "",
        "active_status_name": "Aktif",
        "employee_status": "NON PNS",
        "sdm_type": "Dosen",
        "is_sister_exist": 1,
        "created_at": "2022-12-10T12:45:41.000000Z",
        "updated_at": "2023-01-15T11:37:54.000000Z",
        "program_studi_id": 7,
        "faculty_id": 6,
        "study_program": "ekonomi pembangunan",
        "faculty": "fakultas ekonomi dan bisnis"
        }
    ]
}
```

-   get mahasiswa (wajib mengirimkan query string params)

GET https://kepegawaian.uts.ac.id/api/student

Example

```
https://kepegawaian.uts.ac.id/api/student?angkatan=2013
https://kepegawaian.uts.ac.id/api/student?fakultas=rekayasa
https://kepegawaian.uts.ac.id/api/student?prodi=informatika
https://kepegawaian.uts.ac.id/api/student?angkatan=2013&prodi=informatika&fakultas=rekayasa
```

Headers

```
Accept: application/json
Authorization: Bearer 7|Il0L7nxAezzwrlSAbV7y7c0HZva4DMnCQVBUg4q4

```

Query String Params

```
angkatan=2013
prodi=informatika
fakultas=rekayasa
```

Response

```
{
  "data": [
    {
      "student_id": "bc1qre8jdw2azrg6tf49wmp652w00xltddxmpk98xp",
      "nama_lengkap": "SELESTINO PRABOWO SEQUEIRA",
      "gender": "L",
      "tempat_tanggal_lahir": "Sumbawa Besar/ 03-09-1992",
      "nim": "1301061017",
      "password": "$2y$10$BQBwD2amBfOTPeFfGrgW/OHI5yDYJjurVBxUmdomN/yWKsE38XiXS",
      "nik": "5314032302920004",
      "program_studi_id": "11",
      "sesi_kuliah": "Pagi - 08:30|10:00",
      "periode_masuk": "GANJIL 2013/2014",
      "angkatan": "2013",
      "status_masuk": "Mahasiswa Baru",
      "jalur_masuk": "REGULER 1",
      "status_akademik": "Lulus",
      "status_mahasiswa": "Mahasiswa",
      "agama": "Katholik",
      "status_nikah": "Belum Kawin",
      "kewarganegaraan": "WNI",
      "status_domisili": "Asrama",
      "alamat": "Asrama Kodim 1607 Sumbawa Besar",
      "kelurahan": "Uma Sima",
      "kecamatan": "Kec. Sumbawa                  ",
      "kota_tinggal": "Kab. Sumbawa                  ",
      "kode_pos": "84317",
      "negara": "Indonesia",
      "no_telp": "081339607686",
      "no_hp": "081339607686",
      "email": "Prabowosequeira@gmail.com",
      "study_program": "psikologi",
      "faculty": "fakultas psikologi dan humaniora"
    },
    {
      "student_id": "bc1qre8jdw2azrg6tf49wmp652w00xltddxmpk98xp",
      "nama_lengkap": "Afrian Wira Wardhana",
      "gender": "L",
      "tempat_tanggal_lahir": "1995-04-14/ 14-04-1995",
      "nim": "1301011001",
      "password": "$2y$10$K/K9dAfzkKYC78Lrr0D/8eW82QE9Juy4S9IScORwC1YvM/k7m7RBe",
      "nik": "",
      "program_studi_id": "1",
      "sesi_kuliah": "Pagi - 08:30|10:00",
      "periode_masuk": "GANJIL 2013/2014",
      "angkatan": "2013",
      "status_masuk": "Mahasiswa Baru",
      "jalur_masuk": "REGULER 1",
      "status_akademik": "Lulus",
      "status_mahasiswa": "Mahasiswa",
      "agama": "",
      "status_nikah": "",
      "kewarganegaraan": "",
      "status_domisili": "",
      "alamat": "",
      "kelurahan": "",
      "kecamatan": "",
      "kota_tinggal": "",
      "kode_pos": "",
      "negara": "",
      "no_telp": "",
      "no_hp": "",
      "email": "",
      "study_program": "teknik metalurgi",
      "faculty": "fakultas teknik lingkungan dan mineral"
    }
  ]
}
```
