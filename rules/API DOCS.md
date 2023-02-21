# API DOCS UTS

## Endpoint List

### NOTE

Pastikan mengirim headers setiap request:

Base URL

```
https://kepegawaian.uts.ac.id/api
```

Headers

```

Accept: application/json
Authorization: Bearer access_token

```

### 1. Autentikasi

-   Token dapat diperoleh dengan mengirimkan request:

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
  "data": {
    "access_token": "1|8WPkt0QI3Hlgi42G4VJydWA9f6XlBAwB0RvTZ3Jp",
    "sdm_id": "3656416-df1d-46451-aefdgrg71-372354568"
  }
}
```

### 2. Profile User

Endpoint

```

POST /auth/user

```

Response

```
{
  "data": {
    "sdm_name": "I MADE WIDIARTA",
    "sdm_id": "5ded2223-3d3d-4cd4-bbab-8e041f1aec6c",
    "email": "i.made.widiarta@uts.ac.id",
    "nidn": "0813018701",
    "nip": "0",
    "is_lecturer": true
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
{
  "data": [
    {
      "id": 1,
      "subject_name": "Dasar pemrograman web",
      "class_name": "SPL-2016-A1",
      "study_program": "Teknik Sipil",
      "semester": "Ganjil 2022/2023",
      "sks": 4,
      "number_of_meetings": 16,
      "sdm_id": 98,
      "sdm_name": "I MADE WIDIARTA",
      "value_sks": "0.50",
      "meetings_completed": 2,
      "meetings_pending": 14
    },
    {
      "id": 2,
      "subject_name": "Matematika diskrit",
      "class_name": "SPL-2016-A1",
      "study_program": "Teknik Sipil",
      "semester": "Ganjil 2022/2023",
      "sks": 4,
      "number_of_meetings": 16,
      "sdm_id": 98,
      "sdm_name": "I MADE WIDIARTA",
      "value_sks": "0.25",
      "meetings_completed": 1,
      "meetings_pending": 15
    },
    {
      "id": 3,
      "subject_name": "Matematika sidkrit",
      "class_name": "SPL-2016-A1",
      "study_program": "Teknik Sipil",
      "semester": "Ganjil 2022/2023",
      "sks": 4,
      "number_of_meetings": 16,
      "sdm_id": 98,
      "sdm_name": "I MADE WIDIARTA",
      "value_sks": "0.50",
      "meetings_completed": 2,
      "meetings_pending": 14
    }
  ]
}
```

### 4. Mata Kuliah Hari ini

Endpoint

```
GET /subject/today
```

Response

```
{
  "data" : [
    {
      "id": 1,
      "subject_name": "Dasar pemrograman web",
      "class_name": "SPL-2016-A1",
      "study_program": "Teknik Sipil",
      "semester": "Ganjil 2022/2023",
      "sks": 4,
      "number_of_meetings": 16,
      "sdm_id": 98,
      "sdm_name": "I MADE WIDIARTA",
      "value_sks": "0.50",
      "meetings_completed": 2,
      "meetings_pending": 14
    }
  ]
}
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
    "subject_name": "Dasar pemrograman web",
    "class_name": "SPL-2016-A1",
    "study_program": "Teknik Sipil",
    "semester": "Ganjil 2022/2023",
    "sks": 4,
    "number_of_meetings": 16,
    "sdm_id": 98,
    "sdm_name": "I MADE WIDIARTA",
    "value_sks": "0.50",
    "meetings_completed": 2,
    "meetings_pending": 14
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
{
  "data": [
    {
      "id": 1,
      "meeting_name": "Pertemuan ke 1",
      "date": "2022-12-17T20:23",
      "meeting_start": "2022-12-17T20:23",
      "file": null,
      "url": null
    },
    {
      "id": 2,
      "meeting_name": "Pertemuan ke 2",
      "date": "2022-12-18T13:37",
      "meeting_start": "2022-12-18T13:37",
      "file": "639ea7197d5841671341849download.jfif.jpg",
      "url": null
    },
    ...
    {
      "id": 16,
      "meeting_name": "Pertemuan ke 16",
      "date": null,
      "meeting_start": null,
      "file": null,
      "url": null
    }
  ]
}
```

### 7. Absen Mulai Kelas

Endpoint

```
POST /subject/{subject_id}/meeting/{meeting_id}/start
Ex: POST /subject/1/meeting/1/start
```

Body

```
{
    "file_start": "file",
    "meeting_start": "datetime"
}
```

Response

```
{
  "data": "https://kepegawaian.uts.ac.id/verify?sharer=3&is=63f4677ea2a86"
}
```

### 8. List Absensi Kehadiran

Endpoint

```
GET /presence
```

Response

```
{
  "data": [
    {
      "id": 3,
      "sdm_id": 98,
      "latitude_in": "0",
      "longitude_in": "0",
      "latitude_out": null,
      "longitude_out": null,
      "check_in_date": "Sunday, 18-12-2022",
      "check_out_date": "Sunday, 18-12-2022",
      "check_in_hour": "22:08",
      "check_out_hour": "22:08",
      "hours": "0",
      "minutes": "0"
    },
    {
      "id": 4,
      "sdm_id": 98,
      "latitude_in": "80",
      "longitude_in": "80",
      "latitude_out": "90",
      "longitude_out": "90",
      "check_in_date": "Sunday, 18-12-2022",
      "check_out_date": "Sunday, 18-12-2022",
      "check_in_hour": "22:11",
      "check_out_hour": "22:28",
      "hours": "0",
      "minutes": "17"
    },
    ...
    {
      "id": 6,
      "sdm_id": 98,
      "latitude_in": "80",
      "longitude_in": "80",
      "latitude_out": null,
      "longitude_out": null,
      "check_in_date": "Monday, 19-12-2022",
      "check_out_date": "Monday, 19-12-2022",
      "check_in_hour": "08:29",
      "check_out_hour": "08:29",
      "hours": "0",
      "minutes": "0"
    }
  ]
}
```

### 9. Absensi Kehadiran Masuk

Endpoint

```
POST /presence/check-in
Ex: POST /presence/check-in
```

Body

Jika masuk telat maka harus isi detail dan attachment, pengecekan telat terakhir

```
{
    "latitude": "80",
    "longitude": "80",
    "check_in_time": "date",
    "detail": "text",
    "attachment": "file"
}
```

Response

```
{
  "data": {
    "sdm_id": 98,
    "check_in_time": "2023-02-21 18:45:41",
    "latitude_in": "80",
    "longitude_in": "80",
    "updated_at": "2023-02-21T10:20:34.000000Z",
    "created_at": "2023-02-21T10:20:34.000000Z",
    "id": 12
  }
}
```

### 10. Absensi Kehadiran Pulang

Endpoint

```
POST /presence/check-out
Ex: POST /presence/check-out
```

Body

```
{
    "latitude": "80",
    "longitude": "80",
    "check_in_time": "date"
}
```

Response No Content (204)

### 11. List Absensi Hari Ini

Endpoint

```
POST /presence/today
Ex: POST /presence/today
```

Response

```
{
  "data": {
    "id": 11,
    "sdm_id": 98,
    "latitude_in": "80",
    "longitude_in": "80",
    "check_in_time": "2022-12-19 12:13:18",
    "check_out_time": "2022-12-19 12:13:36",
    "latitude_out": "80",
    "longitude_out": "80",
  }
}
```

### 11. Check Apakah Sudah Telat

Endpoint

```
GET /presence/is-late
Ex: GET /presence/is-late
```

Response

```
{
  "data": true or false
}
```

### 12. List Coordinates

Endpoint

```
GET /coord
Ex: GET /coord
```

Response

```
{
  "data": [
    {
      "latitude": "80",
      "longitude": "80",
    },
    {
      "latitude": "80",
      "longitude": "80",
    },
    {
      "latitude": "80",
      "longitude": "80",
    },
    {
      "latitude": "80",
      "longitude": "80",
    },
  ]
}
```
