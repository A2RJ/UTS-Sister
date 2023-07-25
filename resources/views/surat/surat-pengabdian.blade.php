<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas Pengabdian</title>
    <style>
        @page {
            size: auto;
            size: A4 portrait;
        }

        html {
            margin: 0;
        }

        body {
            max-width: 210mm;
            min-height: 100vh;
            padding: 50px 50px 0 50px;
            padding-left: 50px;
            padding-right: 50px;
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

        .signature-img {
            width: 321.13px;
            height: 283px;
            float: right;
            transform: rotate(0rad) translateZ(0px);
            -webkit-transform: rotate(0rad) translateZ(0px);
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
            width: 40%;
            background-color: salmon;
        }
    </style>
</head>

<body>
    <img class="header-img" src="{{ $kop }}" alt="kop surat">

    <p class="line-height-6">No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
        {{ $values['number'] }}/UTS.WRIII/TU/{{ $values['month'] }}/{{ $values['year'] }}
    </p>
    <p class="line-height-6">Perihal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Surat Tugas Pengabdian</p>
    <p class="line-height-6">Lampiran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;-</p>

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

    <p>Menugaskan Dosen Universitas Teknologi Sumbawa;</p>

    <table class="max-width-table column">
        <tr>
            <th>NO.</th>
            <th>NAMA</th>
            <th>NIDN</th>
            <th>PROGRAM STUDI</th>
            <th>KETERANGAN</th>
        </tr>
        <tr>
            <td>1.</td>
            <td>Nurul Amri Komarudin, S.Si., M.Si.</td>
            <td>0813099302</td>
            <td>Teknik Lingkungan</td>
            <td>Narasumber</td>
        </tr>
        <tr>
            <td>2.</td>
            <td>Chairul Anam Afgani, S.TP., M.P.</td>
            <td>0805039301</td>
            <td>Teknologi Hasil Pertanian</td>
            <td>Narasumber</td>
        </tr>
        <tr>
            <td>3.</td>
            <td>Ihlana Nairfana, S.TP., M.Si.</td>
            <td>0805049102</td>
            <td>Teknologi Hasil Pertanian</td>
            <td>Narasumber</td>
        </tr>
        <tr>
            <td>4.</td>
            <td>Ratna Nurmalita Sari, S.T.P., M.Sc.</td>
            <td>0805019402</td>
            <td>Teknologi Hasil Pertanian</td>
            <td>Moderator</td>
        </tr>
    </table>

    <p style="text-align: justify;">
        Untuk melaksanakan Kegiatan Pengabdian kepada Masyarakat sebagai {{ $values['as'] }}
        dalam kegiatan {{ $values['activity'] }}
        dengan tema “{{ $values['theme'] }}“.
        Yang akan dilaksanakan pada {{ $values['date'] }}, {{ $values['location'] }}.</p>
    <p style="text-align: justify;">Setelah selesai melaksanakan tugas,
        harap saudara menyampaikan laporan kegiatan secara tertulis,
        Demikian surat tugas ini dibuat untuk dilaksanakan dan dipergunakan sebagaimana mestinya.
    </p>

    <div class="signature-container">
        <div class="signature">
            <p>Sumbawa, {{ $values['updated_at'] }}</p>
            <p>Wakil Rektor III</p>
            <p style="margin-top: -10px;">Bidang Riset dan Inovasi</p>
            <p style="font-weight: bold; margin-top: 100px; text-decoration: underline;">Dwi Ariyanti, Ph.D</p>
            <p style="margin-top: -10px;">NIDN. 0804018003</p>
        </div>
    </div>
</body>

</html>