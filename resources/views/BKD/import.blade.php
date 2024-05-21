@extends('layouts.dashboard')

@section('title', 'Import BKD')

@section('content')
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white ">
                        <h3 class="card-title">Import BKD</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bkd.import') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label"> {{ Form::label('file') }}</label>
                                    <div>
                                        {{ Form::file('file', ['class' => 'form-control' . ($errors->has('file') ? ' is-invalid' : ''), 'placeholder' => 'File']) }}
                                        {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                                        @if (session('failed'))
                                        <div class="alert alert-warning mt-2" role="alert">{{ session('failed') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <div class="text-end">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-secondary text-white ">
                        <h3 class="card-title">DATA BKD</h3>
                    </div>
                    <div class="card-body">
                        @if (count($data) != 0)
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Nama Dosen</th>
                                        <th>NIDN</th>
                                        <th>Periode</th>
                                        <th>Jafung</th>
                                        <th>Ab</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>E</th>
                                        <th>Total</th>
                                        <th>Kesimpulan</th>
                                        <th>Ket</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($data as $index => $bkd)
                                    <tr>
                                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                                        <td>{{ $bkd['nama_dosen'] }}</td>
                                        <td>{{ $bkd['nidn'] }}</td>
                                        <td>{{ $bkd['period'] }}</td>
                                        <td>{{ $bkd['jafung'] }}</td>
                                        <td>{{ $bkd['ab'] }}</td>
                                        <td>{{ $bkd['c'] }}</td>
                                        <td>{{ $bkd['d'] }}</td>
                                        <td>{{ $bkd['e'] }}</td>
                                        <td>{{ $bkd['total'] }}</td>
                                        <td>{{ $bkd['summary'] }}</td>
                                        <td>{{ $bkd['description'] }}</td>
                                    </tr>
                                    @empty
                                    <td>No Data Found</td>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between ">
                            {!! $data->links() !!}
                            <div>
                                <a href="{{ route('bkd.remove-session') }}" class="btn btn-warning ms-auto">RESET</a>
                                <a href="{{ route('bkd.store-bkd') }}" class="btn btn-primary ms-auto">Simpan BKD</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection