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
    <a href="{{ route('presence.structural') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Absensi Kehadiran</span>
    </a>
</li>
@endif
@endif