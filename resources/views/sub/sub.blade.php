@extends('layouts.dashboard')
@section('title', 'Unit')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Unit') }}</div>

                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <td>Nama SDM</td>
                                <td>{{ ucwords($sdm->sdm_name) }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>{!! $sdm->sdmRole() !!}</td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="bg-danger ">DAFTAR SP TERAKHIR (DALAM BENTUK TABEL)</p>

                    <div class="mb-3">
                        <h5 class="mb-2">Unit <b>{!! ucfirst($sdm->sdmRole()) !!}</b> </h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama SDM</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sdm_under as $item)
                                <tr>
                                    <td>{{ ucwords($item->sdm_name) }}</td>
                                    <td>{{ ucwords($item->role) }}</td>
                                    <td>
                                        <a href="{{ route('sub.profile', $item->sdm_id) }}" class="btn btn-sm btn-primary">Profile</a>
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