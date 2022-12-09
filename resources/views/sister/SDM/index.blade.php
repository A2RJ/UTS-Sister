@extends('layouts.dashboard')

@section('title', 'Dashboard BKD')

@section('content')
<div class="row">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Daftar SDM Universitas Teknologi Sumbawa</h6>
                <a href="{{ route('human_resource.create') }}">
                    <button type="submit" class="btn btn-primary mb-3">Create</button>
                </a>
                <p class="text-muted mb-3">
                    Klik "Pilih sdm" untuk melihat detail sdm.
                </p>

                <b>
                    ID SDM: {{ session('sdm_id') }} <br>
                    Nama SDM: {{ session('sdm_name') }} <br>
                    <!-- token: {{ session('token') }} -->
                </b>
                <form action="/" class="row mt-3">
                    <div class="col-9">
                        <label for="nama" class="visually-hidden">Password</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Cari nama SDM" autocomplete="off">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Cari</button>
                    </div>
                    <div class="col-auto">
                        <a href="/"><button type="submit" class="btn btn-danger mb-3">Reset</button></a>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>ID SDM</th>
                                <th>NIDN</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sdm as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->sdm_name }}</td>
                                <td>{{ $item->sdm_id }}</td>
                                <td>{{ $item->nidn }}</td>
                                <td>
                                    <a href="{{ route('human_resource.show', ['human_resource' => $item->sdm_id]) }}">
                                        <button class="btn btn-sm btn-outline-primary">Detail</button>
                                    </a>
                                    <a href="{{ route('sdm.set-sdm', ['sdm_id' => $item->sdm_id, 'sdm_name' => $item->sdm_name]) }}">
                                        <button class="btn btn-sm btn-outline-success">Set SDM</button>
                                    </a>
                                    <a href="{{ route('human_resource.edit', ['human_resource' => $item->sdm_id]) }}">
                                        <button class="btn btn-sm btn-outline-warning">Edit</button>
                                    </a>
                                    <a href="{{ route('human_resource.destroy', ['human_resource' => $item->sdm_id]) }}" onclick="return confirm('Are you sure')">
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </a>
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