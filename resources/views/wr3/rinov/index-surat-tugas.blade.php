@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Research Assignments') }}</div>

                <div class="card-body">

                    <a href="{{ route('wr3.research-assignment.create') }}">
                        <button class="btn btn-primary mb-3">Ajukan surat tugas</button>
                    </a>

                    <form action="{{ url()->current() }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">Search</button>
                            <a href="{{ url()->current(false, true) }}" class="btn btn-sm btn-warning">Cancel</a>
                        </div>
                    </form>

                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Aktivitas</th>
                                    <th>Sebagai</th>
                                    <th>Tema</th>
                                    <th>Mulai Tanggal</th>
                                    <th>Selesai Tanggal</th>
                                    <th>Penyelenggara</th>
                                    <th>Lokasi</th>
                                    <th>Dosen Peserta</th>
                                    <th>Nomor</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($researchAssignments as $researchAssignment)
                                <tr>
                                    <td @if ($researchAssignment->status)
                                        class="text-primary"
                                        @else
                                        class="text-danger"
                                        @endif
                                        >
                                        {{ $researchAssignment->user->sdm_name }}
                                    </td>
                                    <td>{{ $researchAssignment->role }}</td>
                                    <td>{{ $researchAssignment->activity }}</td>
                                    <td>{{ $researchAssignment->as }}</td>
                                    <td>{{ $researchAssignment->theme }}</td>
                                    <td>{{ $researchAssignment->dateStart }}</td>
                                    <td>{{ $researchAssignment->dateEnd }}</td>
                                    <td>{{ $researchAssignment->organizer }}</td>
                                    <td>{{ $researchAssignment->location }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($researchAssignment->table as $item)
                                            <li>
                                                <strong>Name:</strong> {{ $item['name'] }}, <br>
                                                <strong>NIDN:</strong> {{ $item['nidn'] }}, <br>
                                                <strong>Program studi:</strong> {{ $item['studyProgram'] }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $researchAssignment->number }}</td>
                                    <td>{{ $researchAssignment->month }}</td>
                                    <td>{{ $researchAssignment->year }}</td>
                                    <td>
                                        @if (auth()->user()->rinov())
                                        <a href="{{ route('wr3.research-assignment.update', ['researchAssignment' => $researchAssignment->id]) }}">
                                            <button class="btn btn-sm btn-primary my-1">Penomoran surat</button>
                                        </a>
                                        @if ($researchAssignment->isDocumentNumberingFilled())
                                        <form action="{{ route('wr3.research-assignment.change-status', ['researchAssignment' => $researchAssignment->id]) }}" method="post">
                                            @csrf
                                            @if ($researchAssignment->status)
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Tolak
                                            </button>
                                            @else
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Terima
                                            </button>
                                            @endif
                                        </form>
                                        @endif
                                        @else
                                        @if ($researchAssignment->status)
                                        <form action="{{ route('wr3.research-assignment.print', ['researchAssignment' => $researchAssignment->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                Print surat
                                            </button>
                                        </form>
                                        @else
                                        <button class="btn btn-sm btn-danger" disabled>
                                            Belum diterima
                                        </button>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $researchAssignments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection