@extends('layouts.dashboard')
@section('title', 'Daftar Proposal')

@section('content')

<style>
    .gap>* {
        margin: 5px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Daftar Proposal</div>

                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('failed'))
                    <div class="alert alert-danger">
                        {{ session()->get('failed') }}
                    </div>
                    @endif
                    <div class="mb-3">
                        <a href="{{ route('proposal.create') }}" class="btn btn-primary">Tambah proposal</a>
                    </div>
                    <form method="GET" action="{{ url()->current() }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                            <a class="btn btn-outline-secondary" href="{{ url()->current(false, false) }}">Cancel</a>
                            <button class="btn btn-outline-primary">Export</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Dosen</th>
                                    <th>Nomor Surat</th>
                                    <th>Judul Proposal</th>
                                    <th>Skema Hibah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($researches as $index => $research)
                                <tr>
                                    <td>{{ $index + $researches->firstItem() }}</td>
                                    <td>{{ $research->humanResource->sdm_name }}</td>
                                    <td>
                                        @if ($research->letterNumber?->number | $research->letterNumber?->month | $research->letterNumber?->year)
                                        {{ $research->letterNumber?->number }}/{{ $research->letterNumber?->month }}/{{ $research->letterNumber?->year }}
                                        @endif
                                    </td>
                                    <td>{{ $research->proposal_title }}</td>
                                    <td>{{ $research->grant_scheme }}</td>
                                    <td class="gap">
                                        <a href="{{ route('proposal.edit', ['proposal' => $research->id]) }}" class="btn btn-outline-primary">Edit </a>
                                        <form action="{{ route('proposal.destroy', ['proposal' => $research->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus item ini?')">Delete</button>
                                        </form>
                                        @if ($research->letterNumber?->number | $research->letterNumber?->month | $research->letterNumber?->year)
                                        <form action="{{ route('proposal.generateLetter', $research->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Download surat</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection