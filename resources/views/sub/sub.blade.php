@extends('layouts.dashboard')
@section('title', 'Unit')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header fw-bolder ">{{ __('Detail Unit') }}</div>

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

                    <!-- <p class="bg-danger mb-3">DAFTAR SP TERAKHIR (DALAM BENTUK TABEL)</p> -->

                    <div class="table-responsive ">
                        <h5 class="mb-2">Unit <b>{!! ucfirst($sdm->sdmRole()) !!}</b> </h5>
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

                    <div class="mb-3">
                        <h3 class="card-title">Daftar BKD</h3>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
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
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Nama Dosen</th>
                                        <th>NIDN</th>
                                        <th>Periode</th>
                                        <th>Status</th>
                                        <th>Jafung</th>
                                        <th>Ab</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>E</th>
                                        <th>Total</th>
                                        <th>Kesimpulan</th>
                                        <th>Deskripsi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($bkds as $bkd)
                                    <tr>
                                        <td>{{ ($bkds->currentPage() - 1) * $bkds->perPage() + $loop->iteration }}</td>
                                        <td>{{ $bkd->sdm->sdm_name }}</td>
                                        <td>{{ $bkd->sdm->nidn }}</td>
                                        <td>{{ $bkd->period }}</td>
                                        <td>{{ $bkd->status }}</td>
                                        <td>{{ ucfirst($bkd->jafung) }}</td>
                                        <td>{{ $bkd->ab }}</td>
                                        <td>{{ $bkd->c }}</td>
                                        <td>{{ $bkd->d }}</td>
                                        <td>{{ $bkd->e }}</td>
                                        <td>{{ $bkd->total }}</td>
                                        <td>{{ $bkd->summary }}</td>
                                        <td>{{ $bkd->description }}</td>
                                    </tr>
                                    @empty
                                    <td>No Data Found</td>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {!! $bkds->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection