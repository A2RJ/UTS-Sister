@extends('layouts.dashboard')
@section('title', 'Profile SDM')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Profile SDM') }}</div>

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

                    <div class="table-responsive mb-5">
                        <h3 class="card-title">Profile SDM</h3>
                        <table class="table table-bordered mb-4">
                            <tbody>
                                <tr>
                                    <td>Nama SDM</td>
                                    <td>{{ ucwords($sdm->sdm_name) }}</td>
                                </tr>
                                <tr>
                                    <td>NIDN</td>
                                    <td>{{ $sdm->nidn }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>{!! ucfirst($sdm->roles()) !!}</td>
                                </tr>
                                <tr>
                                    <td>Status Dosen</td>
                                    <td>{{ $sdm->sdm_type }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan Fungsional</td>
                                    <td>Ambil jafung terakhir</td>
                                </tr>
                                <tr>
                                    <td>Status Serdos</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Status Keaktifan</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-5">
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
                        <div class="float-end ">
                            {!! $bkds->links() !!}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <h3 class="card-title">Daftar Presensi</h3>
                        <form class="mb-4 mt-1" action="{{ url()->current() }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ request('search')}}" placeholder="Search..." autocomplete="off">

                                @if ($withDate)
                                <input type="date" name="start" class="form-control" value="{{ request('start')}}">
                                <input type="date" name="end" class="form-control" value="{{ request('end')}}">
                                @endif
                                <button type="submit" class="btn btn-sm btn-outline-primary">Search</button>
                                <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-outline-warning">Cancel</a>
                            </div>
                        </form>
                        <x-table :header="['Nama', 'NIDN', 'Jabatan', 'Status Kepegawaian', 'Jumlah minimal jam', 'Jumlah jam efektif', 'Jumlah kurang jam', 'Denda', 'Jumlah lebih jam', 'Aksi']">
                            @foreach ($presences as $index => $presence)
                            @php
                            $detail = $presence->compareWorkHours(request('start'), request('end'), $presence->sdm_type, $presence)
                            @endphp
                            <tr>
                                <td>{{ $index + $presences->firstItem() }}</td>
                                <td>{{ $presence->sdm_name }}</td>
                                <td>{{ $presence->nidn }}</td>
                                <td>{!! $presence->roles() !!}</td>
                                <td>{{ $presence->sdm_type }}</td>
                                <td>{{ $detail['targetWorkHours'] }}</td>
                                <td>{{ $presence->effective_hours }}</td>
                                <td>{{ $detail['less'] }}</td>
                                <td>{{ money($detail['penalty'], 'IDR', true) }}</td>
                                <td>{{ $detail['over'] }}</td>
                                <td><a href="{{ route('presence.per-civitas', ['sdm_id' => $presence->id]) }}">Detail</a></td>
                            </tr>
                            @endforeach
                        </x-table>
                        <div class="float-end ">
                            {{ $presences->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection