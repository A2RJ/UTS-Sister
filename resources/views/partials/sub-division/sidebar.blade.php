@if (count(auth()->user()->hasSub()))
<li class="nav-item nav-category">Sub divisi Menu</li>
@if (count(auth()->user()->subHasRoleType('dosen')))
<li class="nav-item">
    <a href="{{ route('presence.sub-lecturer') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Absensi Pengajaran</span>
    </a>
</li>
@endif
@if (count(auth()->user()->subOtherRoleType('dosen')))
<li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
        <i class="link-icon" data-feather="mail"></i>
        <span class="link-title">Absensi Kehadiran</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('presence.sub.permission') }}" class="nav-link">Izin sub divisi</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('presence.per-civitas') }}" class="nav-link">Per Civitas</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('presence.civitas-all') }}" class="nav-link">Semua absensi</a>
            </li>
        </ul>
    </div>
</li>
@endif
@endif