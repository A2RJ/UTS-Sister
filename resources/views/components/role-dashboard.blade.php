<div>
    <!-- <div class="mb-2">
        @if (auth()->user()->isDirAkademik())
        <p>Role and adalah Dir Akademik</p>
        @endif

        @if (auth()->user()->isMissingRole())
        <p>Hubungi admin karena role anda tidak di assign</p>
        @endif

        @if (auth()->user()->isRektor())
        <p>Role anda adalah Rektor</p>
        @endif

        @if (auth()->user()->isAdmin())
        <p>Role anda adalah Admin</p>
        @endif

        @if (auth()->user()->isFaculty())
        <p>Role anda adalah dekan fakultas</p>
        @endif

        @if (auth()->user()->isStudyProgram())
        <p>Role anda adalah ka prodi</p>
        @endif

        @if (auth()->user()->isLecturer())
        <p>Role anda adalah Dosen</p>
        @endif

        @if (auth()->user()->isStructural())
        <p>Role anda adalah Struktural</p>
        @endif

        @if (auth()->user()->isDSDM())
        <p>Role anda adalah DSDM</p>
        @endif

    </div> -->

    <div class="mb-3 mt-3">
        <h5 class="mb-2"> <b>Anda mempunyai jabatan</b> </h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Peran</th>
                    <th>Tipe</th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->structure as $item)
                <tr>
                    <td>{{ ucwords($item->role) }}</td>
                    <td>{{ ucwords($item->type) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-3">
        <h5 class="mb-2"> <b>Anda mempunyai sub unit</b> </h5>
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
                    <th>Nama Subdivisi</th>
                    <th>Peran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->subDivision() as $item)
                <tr>
                    <td>{{ ucwords($item->sdm_name) }}</td>
                    <td>{{ ucwords($item->role) }}</td>
                    <td>
                        <a href="{{ route('sub.sdm', $item->sdm_id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>