 <li class="nav-item nav-category">DSDM Menu</li>
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
     <a class="nav-link" data-bs-toggle="collapse" href="#dsdmAbsensi" role="button" aria-expanded="false" aria-controls="dsdmAbsensi">
         <i class="link-icon" data-feather="mail"></i>
         <span class="link-title">Absensi Kehadiran</span>
         <i class="link-arrow" data-feather="chevron-down"></i>
     </a>
     <div class="collapse" id="dsdmAbsensi">
         <ul class="nav sub-menu">
             <li class="nav-item">
                 <a href="{{ route('dsdm.all-sdm') }}" class="nav-link">Absensi civitas</a>
             </li>
         </ul>
     </div>
 </li>