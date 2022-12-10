 <nav class="sidebar">
     <div class="sidebar-header">
         <a href="#" class="sidebar-brand">
             {{ env('APP_BRAND1') }}<span>{{ env('APP_BRAND2') }}</span>
         </a>
         <div class="sidebar-toggler not-active">
             <span></span>
             <span></span>
             <span></span>
         </div>
     </div>
     <div class="sidebar-body">
         <ul class="nav">
             <li class="nav-item nav-category">Main</li>
             <li class="nav-item">
                 <a href="#" class="nav-link">
                     <i class="link-icon" data-feather="box"></i>
                     <span class="link-title">Dashboard</span>
                 </a>
             </li>
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
                 <a href="{{ route('faculty.index') }}" class="nav-link">
                     <i class="link-icon" data-feather="message-square"></i>
                     <span class="link-title">Fakultas</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('study_program.index') }}" class="nav-link">
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
                 <a href="{{ route('subject.index') }}" class="nav-link">
                     <i class="link-icon" data-feather="message-square"></i>
                     <span class="link-title">Mata Kuliah</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('meeting.index') }}" class="nav-link">
                     <i class="link-icon" data-feather="message-square"></i>
                     <span class="link-title">Jadwal Mata Kuliah</span>
                 </a>
             </li>
             <li class="nav-item">
                 <form action="/logout" method="POST">
                     @csrf
                     <button class="btn btn-danger">Logout</button>
                 </form>
             </li>
             <!-- <li class="nav-item">
                 <a class="nav-link" data-bs-toggle="collapse" href="#dropdownSDM" role="button" aria-expanded="false" aria-controls="dropdownSDM">
                     <i class="link-icon" data-feather="mail"></i>
                     <span class="link-title">BKD</span>
                     <i class="link-arrow" data-feather="chevron-down"></i>
                 </a>
                 <div class="collapse" id="dropdownSDM">
                     <ul class="nav sub-menu">
                         <x-sidebar-menu></x-sidebar-menu>
                     </ul>
                 </div>
             </li> -->
         </ul>
     </div>
 </nav>