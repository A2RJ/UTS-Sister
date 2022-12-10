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
                 <a href="{{ route('attendance.index') }}" class="nav-link">
                     <i class="link-icon" data-feather="box"></i>
                     <span class="link-title">Dashboard</span>
                 </a>
             </li>
             <li class="nav-item nav-category">Dosen Menu</li>
             <li class="nav-item">
                 <a href="{{ route('subject.byLecturer') }}" class="nav-link">
                     <i class="link-icon" data-feather="message-square"></i>
                     <span class="link-title">Mata Kuliah</span>
                 </a>
             </li>
             <li class="nav-item">
                 <form action="/logout" method="POST">
                     @csrf
                     <button class="btn btn-danger">Logout</button>
                 </form>
             </li>
         </ul>
     </div>
 </nav>