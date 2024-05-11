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
  "password": "password123",
  "mac_address": "contohmac"
}

```

Error missing form

```
{
  "error": {
    "mac_address": [
      "The mac address field is required."
    ],
    "email": [
      "The email field is required."
    ],
    "password": [
      "The password field is required."
    ]
  }
}
```

Error login with different device

```

{
  "error": "You have logged from a different device."
}
```

Error account not registered or invalid cridentals

```
{
  "error": "Your account is not registered."
}
{
  "error": "The provided credentials are incorrect."
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

### 8. Daftar Absensi Kehadiran

Endpoint

```
GET /presence
Optional GET /presence?start=2023-03-278&end=2023-03-31
```

Query Params (Optional)

```
start = 2023-03-27
end = 2023-03-31
```

Description

-   Default: Getting the total working hours for the current week in the calendar

Response

```
{
  "data": {
      "presences": [
        {
          "id": 2484,
          "sdm_id": 12,
          "check_in_date": "Monday, 27-03-2023",
          "check_out_date": "Monday, 27-03-2023",
          "check_in_hour": "09:13",
          "check_out_hour": "16:45",
          "effective_hours": "06:46:10",
          "ineffective_hours": "00:00:00"
        },
        {
          "id": 2643,
          "sdm_id": 12,
          "check_in_date": "Tuesday, 28-03-2023",
          "check_out_date": "Tuesday, 28-03-2023",
          "check_in_hour": "08:49",
          "check_out_hour": "15:25",
          "effective_hours": "06:25:28",
          "ineffective_hours": "00:00:00"
        }
      ],
    "effective_hours": {
      "sdm_name": "AHMAD JULIANSYAH",
      "id": 12,
      "effective_hours": "13:11:38",
      "ineffective_hours": "00:00:00"
    }
  }
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
    "check_out_time": "date"
}
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

### 12. Check Apakah Sudah Telat

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

### 13. List Coordinates

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
      "latitude": "-8.569655",
      "longitude": "117.432436"
    },
    {
      "latitude": "-8.5699827",
      "longitude": "117.4318655"
    },
    {
      "latitude": "-8.5699827",
      "longitude": "117.4318655"
    },
    {
      "latitude": "-8.5699827",
      "longitude": "117.4318655"
    },
    {
      "latitude": "-8.5709854",
      "longitude": "117.4311414"
    },
    {
      "latitude": "-8.5709854",
      "longitude": "117.4311414"
    },
    {
      "latitude": "-8.5709854",
      "longitude": "117.4311414"
    }
  ]
}
```

### 14. Get work hours

Endpoint

```
GET /presence/total-hour
Ex: GET /presence/total-hour?start=2023-03-278&end=2023-03-31
```

Query Params (Optional)

```
start = 2023-03-27
end = 2023-03-31
```

Description

-   Default: Getting the total working hours for the current week in the calendar

Response

```
{
  "data": {
    "sdm_name": "AHMAD JULIANSYAH",
    "id": 12,
    "effective_hours": "13:11:38",
    "ineffective_hours": "00:00:00"
  }
}
```

### 15. GET permission type

Endpoint

```
GET /permission/type
```

Description:
Returns a list of available permission types.

Response

```
{
  "data": [
    {
      "id": 1,
      "jenis_izin": "Izin Cuti"
    },
    {
      "id": 2,
      "jenis_izin": "Izin Sakit"
    },
    {
      "id": 3,
      "jenis_izin": "Izin Berkegiatan Diluar 1/2 Hari"
    },
    {
      "id": 4,
      "jenis_izin": "Izin Berkegiatan Diluar 1 Hari Atau Lebih"
    },
    {
      "id": 5,
      "jenis_izin": "Terkendala Absen Masuk"
    },
    {
      "id": 6,
      "jenis_izin": "Terkendala Absen Pulang"
    }
  ]
}
```

### 16. GET user permission

Endpoint

```
GET /permission/me
```

Description:

-   Returns a list of permissions submitted by the authenticated user.
-   The base URL for attachment is https://kepegawaian.uts.ac.id/download/presense/{attachment}

Response

```
{
    "data": [
        {
            "id": 1,
            "sdm_id": 1,
            "sdm_name": "John Doe",
            "created_at": "2023-03-29T13:25:00.000000Z",
            "attachment": {
                "id": 1,
                "presence_id": 1,
                "detail": "contoh detail 1",
                "attachment": "/storage/attachments/test.jpg"
            }
        },
        {
            "id": 2,
            "sdm_id": 1,
            "sdm_name": "John Doe",
            "created_at": "2023-03-28T09:30:00.000000Z",
            "attachment": null
        }
    ]
}
```

### 17. GET user sub permission

Endpoint

```
GET /permission/sub
```

Description:

-   Returns a list of permissions submitted by the sub-division user.
-   The base URL for attachment is https://kepegawaian.uts.ac.id/download/presense/{attachment}

Response

```
{
    "data": [
        {
            "id": 1,
            "sdm_id": 1,
            "sdm_name": "John Doe",
            "created_at": "2023-03-29T13:25:00.000000Z",
            "attachment": {
                "id": 1,
                "presence_id": 1,
                "detail": "contoh detail 1",
                "attachment": "/storage/attachments/test.jpg"
            }
        },
        {
            "id": 2,
            "sdm_id": 1,
            "sdm_name": "John Doe",
            "created_at": "2023-03-28T09:30:00.000000Z",
            "attachment": null
        }
    ]
}
```

### 18. POST new permission

Endpoint

```
POST /permission
```

Description:
Submits a new permission request for the authenticated user.

Body

| field      |     Type      |                         Required |                                                                                                                                                           Description |
| ---------- | :-----------: | -------------------------------: | --------------------------------------------------------------------------------------------------------------------------------------------------------------------: |
| jenis_izin | integer (1-6) |                         required |                                                                    Specifies the type of permission being requested from<br />the list of available permission types. |
| detail     |    string     |                         required |                                                                                                                        Provides details about the permission request. |
| attachment |     file      |                         required |                                                                       Any supporting documentation for the permission request.<br />(mimes:doc,docx,pdf,jpeg,jpg,png) |
| start_date |    string     | required if jenis_izin is 1 to 4 |                                                                                                                        Start date is the start date of the permission |
| end_date   |    string     |                         nullable | Start date is the date the permit ends,<br />if this column is filled then the permit will automatically <br />fill in the permit in the range of start and end dates |

Error Response

```
- Form is missing
{
    "errors": {
        "jenis_izin": [
            "The jenis izin field is required."
        ],
        "detail": [
            "The detail field is required."
        ],
        "attachment": [
            "The attachment field is required."
        ],
        "start_date": [
            "The start date field is required."
        ],
        "end_date": [
            "The end date field is required."
        ]
    }
}

- For 'jenis_izin' 6 (Terkendala absen pulang), there must be data of attendance in, otherwise an error will occur
{
  error: 'Anda belum absen masuk hari ini'
}

- If user already check in or check out in the same day
{
  error: 'Anda sudah mengisi ijin hari ini'
  or
  error: 'Anda sudah mengisi absen pulang hari ini'
}
```

Response

```
{
    "data": true
}
```

### 19. POST approve permission

Endpoint

```
POST /permission/{presence->id}
```

Description:
Approve a permission request from sub-division.

Error Response

```
- Because the person who approved is not their directur/supervisor
{
  error: 'Anda tidak dapat memberikan izin'
}
```

Response

```
{
    "data": true
}
```

### 20. DELETE delete permission

Endpoint

```
DELETE /permission/{presence->id}
```

Description:
Delete a permission.

Response

```
{
    "data": true
}
```
