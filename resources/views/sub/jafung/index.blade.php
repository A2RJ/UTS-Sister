@extends('layouts.dashboard')

@section('title')
Jafung
@endsection

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    List
                </div>
                <h2 class="page-title">
                    {{ __('Jafung ') }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('jafung.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Create Jafung
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jafung</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <form action="{{ url()->current() }}" method="get">
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
                                        <input type="text" class="form-control form-control-sm" name="jafung" value="{{ request('jafung') }}">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-warning">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive min-vh-100">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No.</th>
                                    <th>Human Resource Id</th>
                                    <th>Jafung</th>
                                    <th>Sk Number</th>
                                    <th>Start From</th>
                                    <th>Attachment</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($jafungs as $jafung)
                                <tr>
                                    <td>{{ ($jafungs->currentPage() - 1) * $jafungs->perPage() + $loop->iteration }}</td>
                                    <td>{{ $jafung->sdm->sdm_name }}</td>
                                    <td>{{ $jafung->jafung }}</td>
                                    <td>{{ $jafung->sk_number }}</td>
                                    <td>{{ $jafung->start_from }}</td>
                                    <td>
                                        <a href="{{ route('jafung.attachment', $jafung->attachment) }}" target="_blank">View Attachment</a>
                                    </td>

                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('jafung.edit',$jafung->id) }}">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('jafung.destroy',$jafung->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="if(!confirm('Do you Want to Proceed?')){return false;}" class="dropdown-item text-red"><i class="fa fa-fw fa-trash"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td>No Data Found</td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        {!! $jafungs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection