<!DOCTYPE html>
<!--
    Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
    Author: NobleUI
    Website: https://www.nobleui.com
    Portfolio: https://themeforest.net/user/nobleui/portfolio
    Contact: nobleui123@gmail.com
    Purchase: https://1.envato.market/nobleui_admin
    License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('/themeforest/NobleUI/template/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('/themeforest/NobleUI/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/themeforest/NobleUI/template/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('/themeforest/NobleUI/template/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('/themeforest/NobleUI/template/assets/css/demo1/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('/themeforest/NobleUI/template/assets/images/favicon.png') }}" />
    @vite('resources/js/app.js')
</head>

<body>
    <div class="main-wrapper">
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
                    <li class="nav-item nav-category">Main menu</li>
                    <li class="nav-item">
                        <a href="{{ route('presence.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>

                    @if (auth()->check())
                    @include('partials.user.sidebar')
                    @endif

                    @if (auth()->user()->isRektor())
                    <p>Rektor</p>
                    @endif

                    @if (auth()->user()->isAdmin())
                    @include('partials.admin.sidebar')
                    @endif

                    @if (auth()->user()->isLecturer())
                    @include('partials.lecturer.sidebar')
                    @endif

                    @if (auth()->user()->isFaculty())
                    @include('partials.faculty.sidebar')
                    @endif

                    @if (auth()->user()->isStudyProgram())
                    @include('partials.study-program.sidebar')
                    @endif

                    @if (auth()->user()->hasSub())
                    @include('partials.sub-division.sidebar')
                    @endif

                    <li class="nav-item nav-category">Auth</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="link-icon" data-feather="message-square"></i>
                            <span class="link-title">{{ __('Logout') }}</span>
                        </a>


                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </nav>

        <div class="page-wrapper">

            @include('partials.navbar')

            <div class="page-content">
                @yield('content')
            </div>

            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>.</p>
                <p class="text-muted">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm" data-feather="heart"></i></p>
            </footer>
        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('/themeforest/NobleUI/template/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    @yield('plugin_js')
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('/themeforest/NobleUI/template/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('/themeforest/NobleUI/template/assets/js/template.') }}js"></script>
    <!-- endinject -->
    {{-- Custom js --}}
    @yield('custom_js')
    <!-- End custom js for this page -->

</body>


</html>