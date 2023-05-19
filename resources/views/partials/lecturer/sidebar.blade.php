 <li class="nav-item nav-category">Dosen Menu</li>
 <li class="nav-item">
     <a href="{{ route('subject.my-subject') }}" class="nav-link">
         <i class="link-icon" data-feather="message-square"></i>
         <span class="link-title">Pengajaran</span>
     </a>
 </li>
 <li class="nav-item nav-category">Warek III</li>
 <li class="nav-item">
     <a class="nav-link" data-bs-toggle="collapse" href="#rinov" role="button" aria-expanded="false" aria-controls="rinov">
         <i class="link-icon" data-feather="list"></i>
         <span class="link-title">Riset Inovasi</span>
         <i class="link-arrow" data-feather="chevron-down"></i>
     </a>
     <div class="collapse" id="rinov">
         <ul class="nav sub-menu">
             <li class="nav-item">
                 <a href="{{ route('rinov.data-dosen') }}" class="nav-link">Data dosen</a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('rinov.proposal') }}" class="nav-link">Proposal</a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('rinov.kegiatan-luar-kampus') }}" class="nav-link">Kegiatan di luar kampus</a>
             </li>
         </ul>
     </div>
 </li>