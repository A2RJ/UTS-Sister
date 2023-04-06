@extends('layouts.dashboard')

@section('title', 'Daftar Civitas')

@section('content')
<div class="row">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Daftar SDM Universitas Teknologi Sumbawa</h6>
                <a href="{{ route('human_resource.create') }}">
                    <button type="submit" class="btn btn-primary mb-3">Tambah</button>
                </a>
                <p class="text-muted mb-3">
                    Klik "Pilih sdm" untuk melihat detail sdm.
                </p>

                <b>
                    ID SDM: {{ session('sdm_id') }} <br>
                    Nama SDM: {{ session('sdm_name') }} <br>
                </b>

                <form class="mb-4" action="{{ url()->current() }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search')}}" placeholder="Search..." autocomplete="off">
                        <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
                        <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
                    </div>
                </form>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Email</th>
                                <th>NIDN</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sdm as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->sdm_name }}</td>
                                <td>{{ $item->roles() }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->nidn }}</td>
                                <td>
                                    <a href="{{ route('human_resource.show', ['human_resource' => $item->sdm_id]) }}">
                                        <button class="btn btn-sm btn-outline-primary">Detail</button>
                                    </a>
                                    @if ($item->is_sister_exist)
                                    <a href="{{ route('sdm.set-sdm', ['sdm_id' => $item->sdm_id, 'sdm_name' => $item->sdm_name]) }}">
                                        <button class="btn btn-sm btn-outline-primary">Set SDM</button>
                                    </a>
                                    @endif
                                    <a href="{{ route('human_resource.edit', ['human_resource' => $item->sdm_id]) }}">
                                        <button class="btn btn-sm btn-outline-warning mr-1 mb-1">Edit</button>
                                    </a>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('human_resource.resetPassword', ['human_resource' => $item->sdm_id]) }}" onclick="return confirm('Yakin reset password (NIDN - {{ $item->nidn }}) untuk {{ $item->sdm_name }}?')">
                                            <button class="btn btn-sm btn-outline-danger">Reset password</button>
                                        </a>
                                        <x-delete action="{{ route('human_resource.destroy', ['human_resource' => $item->sdm_id]) }}" />
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2 float-right">
                        {{ $sdm->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection