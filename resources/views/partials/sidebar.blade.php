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
                 <a href="/" class="nav-link">
                     <i class="link-icon" data-feather="box"></i>
                     <span class="link-title">Dashboard</span>
                 </a>
             </li>
             <li class="nav-item nav-category">SDM Menu</li>
             @if (session('id_sdm'))
                 <x-sidebar-menu></x-sidebar-menu>
             @endif
         </ul>
     </div>
 </nav>
