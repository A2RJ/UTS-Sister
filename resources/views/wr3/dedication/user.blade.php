@extends('layouts.dashboard')
@section('title', 'Daftar Pengabdian')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Pengabdian</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('dedication.create') }}" class="btn btn-primary">Tambah Pengabdian</a>
                    </div>
                    <form action="{{ route('dedication.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ $search }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                            <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul</th>
                                    <th>File Proposal</th>
                                    <th>Waktu Kegiatan</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dedications as $dedication)
                                <tr>
                                    <td>{{ $dedications->firstItem() + $loop->index }}</td>
                                    <td>{{ $dedication->humanResource->sdm_name }}</td>
                                    <td>
                                        @if ($dedication->letterNumber?->number | $dedication->letterNumber?->month | $dedication->letterNumber?->year)
                                        {{ $dedication->letterNumber?->number }}/{{ $dedication->letterNumber?->month }}/{{ $dedication->letterNumber?->year }}
                                        @endif
                                    </td>
                                    <td>{{ $dedication->title }}</td>
                                    <td>
                                        <a href="{{ route('download.pengabdian', ['filename' => base64_encode($dedication->proposal_file)]) }}">File</a>
                                    </td>
                                    <td>{{ $dedication->activity_schedule }}</td>
                                    <td>{{ $dedication->location }}</td>
                                    <td>
                                        <a href="{{ route('dedication.edit', $dedication->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('dedication.destroy', $dedication->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this dedication?')">Delete</button>
                                        </form>
                                        @if ($dedication->letterNumber?->number | $dedication->letterNumber?->month | $dedication->letterNumber?->year)
                                        <a href="{{ route('dedication.generateLetter', $dedication->id) }}" class="btn btn-primary">Download surat</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $dedications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection