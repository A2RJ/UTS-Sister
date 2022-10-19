<div>
    <tr>
        <th>No.</th>
        <th>Nama Dokumen</th>
        <th>Nama File</th>
        <th>Jenis File</th>
        <th>Tanggal Upload</th>
        <th>Jenis Dokumen</th>
        <th>Aksi</th>
    </tr>
    @foreach ($document as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['nama_file'] }}</td>
            <td>{{ $item['jenis_file'] }}</td>
            <td>{{ $item['tanggal_upload'] }}</td>
            <td>{{ $item['jenis_dokumen'] }}</td>
            <td>
                <a href="{{ $item['tautan'] }}">
                    Download
                </a>
                <a href="">
                    Detail
                </a>
            </td>
        </tr>
    @endforeach
</div>
