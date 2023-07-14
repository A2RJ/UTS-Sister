<li class="nav-item nav-category">Absensi Menu</li>
<li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#userMenu" role="button" aria-expanded="false" aria-controls="userMenu">
        <i class="link-icon" data-feather="list"></i>
        <span class="link-title">Absensi Kehadiran</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="userMenu">
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{ route('presence.my-presence') }}" class="nav-link">Absensi saya</a>
            </li>
            @if (count(auth()->user()->subDivision()))
            <li class="nav-item">
                <a href="{{ route('presence.sub-presence') }}" class="nav-link">Absensi Sub divisi</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('presence.sub.permission') }}" class="nav-link">Izin Sub divisi</a>
            </li>
            @endif
        </ul>
    </div>
</li>
<!-- <li class="nav-item nav-category">Dosen Menu</li>
<li class="nav-item">
    <a href="{{ route('subject.my-subject') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Pengajaran</span>
    </a>
</li> -->
<li class="nav-item nav-category">Warek III</li>
<li class="nav-item">
    <a href="{{ route('rinov.data-dosen') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Data dosen</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dedication.by-user') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Pengabdian</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('proposal.by-user') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Proposal</span>
    </a>
</li>