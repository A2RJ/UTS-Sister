 <li class="nav-item nav-category">DSDM Menu</li>
 <li class="nav-item">
     <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
         <i class="link-icon" data-feather="mail"></i>
         <span class="link-title">Absensi Kehadiran</span>
         <i class="link-arrow" data-feather="chevron-down"></i>
     </a>
     <div class="collapse" id="emails">
         <ul class="nav sub-menu">
             <li class="nav-item">
                 <a href="{{ route('presence.dsdm-civitas') }}" class="nav-link">Per dosen</a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('presence.dsdm-civitas-all') }}" class="nav-link">Semua absensi</a>
             </li>
         </ul>
     </div>
 </li>