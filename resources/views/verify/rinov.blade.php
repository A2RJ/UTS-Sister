<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas Riset Inovasi</title>
    <style>
        @page {
            size: auto;
            size: A4 portrait;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 210mm;
            min-height: 100vh;
            padding: 50px;
            background-color: white;
            font-size: 12pt;
            font-family: "Times New Roman", serif;
        }


        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            line-height: 0.8;
        }

        th {
            font-weight: bold;
        }

        .column {
            font-size: 11pt;
        }

        .max-width-table {
            max-width: 210mm;
        }

        .header-img {
            width: 100%;
            height: 91.8px;
        }

        .no-border th,
        .no-border td {
            border: none;
        }

        .line-height-6 {
            line-height: .6;
        }

        .signature-container {
            display: flex;
            justify-content: end;
        }

        .signature {
            width: 33%;
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 style="color: green;">Verifikasi Data Berhasil</h1>
        <img class="header-img" src="{{ $kop }}" alt="kop surat">

        <p class="line-height-6">No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
            {{ $values['number'] }}/UTS.WRIII/TU/{{ $values['month'] }}/{{ $values['year'] }}
        </p>
        <p class="line-height-6">Perihal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Surat Tugas Penelitian</p>
        <p class="line-height-6">Lampiran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: -</p>

        <p>Yang bertanda tangan dibawah ini :</p>
        <table class="no-border column">
            <tr>
                <td>Nama</td>
                <td>: Dwi Ariyanti, Ph.D</td>
            </tr>
            <tr>
                <td>NIDN</td>
                <td>: 0804018003</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: Wakil Rektor III Bidang Riset dan Inovasi Universitas Teknologi Sumbawa</td>
            </tr>
        </table>

        <p>Menugaskan Dosen Universitas Teknologi Sumbawa:</p>

        <table class="max-width-table column">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NAMA</th>
                    <th>NIDN</th>
                    <th>PROGRAM STUDI</th>
                    <th>PERAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                $index = 1;
                @endphp
                @foreach ($values['participants'] as $value)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->nidn }}</td>
                    <td>{{ $value->studyProgram }}</td>
                    <td>{{ $value->detail }}</td>
                </tr>
                @php
                $index++;
                @endphp
                @endforeach
            </tbody>
        </table>

        <p style="text-align: justify;">
            Untuk melakukan kegiatan penelitian dengan judul “{{ $values['title'] }}“,
            yang akan dilaksanakan pada {{ $values['start'] }} - {{ $values['end'] }}, berlokasi di {{ $values['location'] }}.</p>
        <p style="text-align: justify;">Setelah selesai melaksanakan tugas,
            harap saudara menyampaikan laporan kegiatan secara tertulis.
            Demikian surat tugas ini dibuat untuk dilaksanakan dan digunakan sebagaimana mestinya.
        </p>
        <div class="signature-container">
            <div class="signature">
                <p>Sumbawa, {{ $values['accepted_date'] }}</p>
                <p>Wakil Rektor III</p>
                <p style="margin-top: -10px;">Bidang Riset dan Inovasi</p>
                <div id="qrcode"></div>
                <p style="font-weight: bold; text-decoration: underline;">Dwi Ariyanti, Ph.D</p>
                <p style="margin-top: -10px;">NIDN. 0804018003</p>
            </div>
        </div>
    </div>

   <script src="{{ asset('js/qr.js') }}"></script>

    <script type="text/javascript">
        try {
            document.addEventListener('keydown', function(event) {
                if (event.ctrlKey && event.key === 'p') {
                    event.preventDefault();
                }
            });
            window.addEventListener("load", function() {
                new QRCode(document.getElementById("qrcode"), {
                    text: "{{ $values['token'] }}",
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            });
        } catch (error) {
            alert("Error while generate this page, please contact administrator")
        }
    </script>
</body>

</html>