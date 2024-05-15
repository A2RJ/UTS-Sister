@extends('layouts.dashboard')
@section('title', 'Profile SDM')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Profile SDM') }}</div>

                <div class="card-body">
                    <!-- 
                        Memiliki
                        - data profile
                        - data jafung
                        - data bkd
                        - data SP
                        - data rekapan absensi dan pemotongan pada bulan aktif
                        - data absensi
                     -->
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
@endsection