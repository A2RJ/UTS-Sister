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