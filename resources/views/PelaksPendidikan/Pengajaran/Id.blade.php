@extends('layout.dashboard')

@section('title', 'Title')

@section('content')
    <div class="card p-2">
        <table>
            <tr>
                <td>Sks Total Persubstansi</td>
                <td>{{ $data['sks'] }}</td>
            </tr>
            <tr>
                <td>Sks Tatap Muka Persubstansi</td>
                <td>{{ $data['sks_tatap_muka'] }}</td>
            </tr>
            <tr>
                <td>Sks Praktek Persubstansi</td>
                <td>{{ $data['sks_praktik'] }}</td>
            </tr>
            <tr>
                <td>Sks Praktek Lapangan Persubstansi</td>
                <td>{{ $data['sks_praktik_lapangan'] }}</td>
            </tr>
            <tr>
                <td>SKS Simulasi Persubstansi</td>
                <td>{{ $data['sks_simulasi'] }}</td>
            </tr>
            <tr>
                <td>Jumlah Tatap Muka Rencana</td>
                <td>{{ $data['tatap_muka_rencana'] }}</td>
            </tr>
            <tr>
                <td>Jumlah Tatap Muka Realisasi</td>
                <td>{{ $data['tatap_muka_realisasi'] }}</td>
            </tr>
            <tr>
                <td>Jumlah Mahasiswa</td>
                <td>{{ $data['jumlah_mahasiswa'] }}</td>
            </tr>
            <tr>
                <td>Nama Matakuliah</td>
                <td>{{ $data['mata_kuliah'] }}</td>
            </tr>
            <tr>
                <td>Nama Kelas</td>
                <td>{{ $data['kelas'] }}</td>
            </tr>
            <tr>
                <td>Jenis Matakuliah</td>
                <td>Wajib <b>Manual karena tidak ada pada API</b></td>
            </tr>
            <tr>
                <td>Jenis Evaluasi</td>
                <td>{{ $data['jenis_evaluasi'] }}</td>
            </tr>
            <tr>
                <td>Nama Substansi</td>
                <td>{{ $data['nama_substansi'] }}</td>
            </tr>
        </table>
    </div>
@endsection
