<li class="nav-item nav-category">Admin Menu</li>
<li class="nav-item">
    <a href="{{ route('human_resource.index') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Civitas</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('structure.index') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Jabatan Struktural</span>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Fakultas</span>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Program Studi</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('class.index') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Daftar Kelas</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('semester.index') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Semester</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('subject.index') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Mata Kuliah</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('comments') }}" class="nav-link">
        <i class="link-icon" data-feather="mail"></i>
        <span class="link-title">Komentar</span>
    </a>
</li>
<!-- <li class="nav-item nav-category">BKD Menu</li>
@if (session('sdm_id'))
<x-sidebar-menu></x-sidebar-menu>
@endif -->
<!-- <li class="nav-item">
    <a href="{{ route('meeting.index') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Jadwal Mata Kuliah</span>
    </a>
</li> -->