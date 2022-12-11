# API DOCS UTS

## Endpoint List

### NOTE

Pastikan mengirim headers setiap request:

Headers

```

Accept: application/json
Authorization: bearer access_token

```

### 1. Autentikasi

-   Untuk mengakses API ini, Anda perlu menyertakan token API di setiap request. Token dapat diperoleh dengan mengirimkan request:

Endpoint

```

POST /auth/token

```

Headers

```

Content-Type: application/json

```

Body

```

{
  "email": "johndoe@example.com",
  "password": "password123"
}

```

Response

```

{
  "data" : {
    "access_token": "1000|98rw90er89wncrw9mrwen7yrcwer"
  }
}

```

### 2. profile user

Endpoint

```

POST /auth/user

```

Response

```

{
  "data": {
    "id": 237,
    "sdm_id": "3656456-df9d-46456-aefdgrg71-376454568",
    "sdm_name": "ARDIANSYAH PUTRA",
    "email": "ardiansyah.putra@uts.ac.id",
    "nidn": "83947838749",
    "nip": "",
    "active_status_name": "Aktif",
    "employee_status": "NON PNS",
    "sdm_type": "Tenaga Kependidikan",
    "faculty_id": null,
    "study_program_id": null,
    "structure_id": 1,
    "created_at": "2022-12-10T20:45:41.000000Z",
    "updated_at": "2022-12-10T20:47:39.000000Z"
  }
}

```

### 3. Daftar Mata Kuliah

Endpoint

```
GET /subject
```

Response

```
[
  "data": [
    {
      "id": 1,
      "subject": "Dasar pemrograman web",
      "sks": 4,
      "number_of_meetings": 16,
      "study_program_id": 1,
      "sdm_id": 237,
      "meetings_completed": "1",
      "meetings_pending": "15",
      "value_sks": "0.25",
      "study_program": {
        "id": 1,
        "faculty_id": 1,
        "study_program": "informatika"
      }
    }
  ]
]
```

### 4. Mata Kuliah Hari ini

Endpoint

```
GET /subject/today
```

Response

```
[
    "data" : [
      {
        "id": 1,
        "subject": "Dasar pemrograman web",
        "sks": 4,
        "number_of_meetings": 16,
        "study_program_id": 1,
        "sdm_id": 237,
        "meetings_completed": "1",
        "meetings_pending": "15",
        "value_sks": "0.25",
        "study_program": {
          "id": 1,
          "faculty_id": 1,
          "study_program": "informatika"
        }
      }
    ]
]
```

### 5. Mata Kuliah By Id

Endpoint

```
GET /subject/{subject_id}
Ex: GET /subject/1
```

Response

```
{
  "data": {
      "id": 1,
      "subject": "Dasar pemrograman web",
      "sks": 4,
      "number_of_meetings": 16,
      "study_program_id": 1,
      "sdm_id": 237,
      "meetings_completed": "1",
      "meetings_pending": "15",
      "value_sks": "0.25",
      "study_program": {
        "id": 1,
        "faculty_id": 1,
        "study_program": "informatika"
      }
  }
}
```

### 6. Jadwal By Mata Kuliah

Endpoint

```
GET /subject/{subject_id}/meeting
Ex: GET /subject/1/meeting
```

Response

```
[
  "data": [
      {
      "id": 1,
      "subject_id": 1,
      "meeting_name": "Pertemuan ke 1",
      "date": "2022-12-10T20:50",
      "meeting_start": "2022-12-10T20:50",
      "meeting_end": "2022-12-10T20:50",
      "file_start": "C:\\xampp\\tmp\\php50D.tmp",
      "file_end": "C:\\xampp\\tmp\\php50E.tmp"
    },
    {
      "id": 2,
      "subject_id": 1,
      "meeting_name": "Pertemuan ke 2",
      "date": null,
      "meeting_start": null,
      "meeting_end": null,
      "file_start": null,
      "file_end": null
    },
    ...
    {
      "id": 16,
      "subject_id": 1,
      "meeting_name": "Pertemuan ke 16",
      "date": null,
      "meeting_start": null,
      "meeting_end": null,
      "file_start": null,
      "file_end": null
    }
  ]
]
```

### 7. Absen Mulai Kelas

Endpoint

```
POST /subject/{subject_id}/start-meeting/{meeting_id}
Ex: POST /subject/1/start-meeting/1
```

Body

```
{
    "file_start": "upload file with"
}
```

Response

```
{
  "data":  {
      "id": 1,
      "subject_id": 1,
      "meeting_name": "Pertemuan ke 1",
      "date": "2022-12-10T20:50",
      "meeting_start": "2022-12-11 06:46:09",
      "meeting_end": null,
      "file_start": "63957cb1577431670741169-156.png",
      "file_end": null
  }
}
```

### 8. Absen Selesai Kelas

Endpoint

```
POST /subject/{subject_id}/end-meeting/{meeting_id}
Ex: POST /subject/1/end-meeting/1
```

Body

```
{
    "file_start": "upload file with"
}
```

Response

```
{
  "data": {
      "id": 1,
      "subject_id": 1,
      "meeting_name": "Pertemuan ke 1",
      "date": "2022-12-10T20:50",
      "meeting_start": "2022-12-11 06:46:09",
      "meeting_end": "2022-12-11 06:47:34",
      "file_start": "63957cb1577431670741169-156.png",
      "file_end": "63957d065151c1670741254-156.png"
  }
}
```
