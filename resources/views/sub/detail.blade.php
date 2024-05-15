@extends('layouts.dashboard')
@section('title', 'Detail Unit')

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
                                <td>{{ $sdm->sdmRole() }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mb-3 table-responsive ">
                        <h5 class="mb-2">Unit <b>{{ ucfirst($sdm->sdmRole()) }}</b> </h5>
                        <div class="d-flex mb-3">
                            <div class="text-muted">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value="10" size="3" aria-label="Invoices count">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-muted">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                                </div>
                            </div>
                        </div>
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
                        <div class="mt-3 float-end ">
                            {{ $sdm_under->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection