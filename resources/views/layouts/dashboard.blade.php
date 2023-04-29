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

    @vite(['resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="shortcut icon" href="{{ asset('/themeforest/NobleUI/template/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="main-wrapper">
        <nav class="sidebar">
            <div class="sidebar-header" style="height: 100px;">
                <a href="#" class="sidebar-brand mx-auto">
                    <img src="{{ asset('/presensi.png') }}" width="50" height="50" class="rounded mx-auto d-block" />
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
                            <i class="link-icon" data-feather="home"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>

                    @if (auth()->check())
                    @include('partials.user.sidebar')
                    @endif

                    @if (auth()->user()->isRektor())
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

                    @if (auth()->user()->isDirAkademik())
                    @include('partials.akademik.sidebar')
                    @endif

                    @if (auth()->user()->isDSDM() || auth()->user()->isRektor() || auth()->user()->isAdmin())
                    @include('partials.dsdm.sidebar')
                    @endif

                    @if (auth()->user()->is_sister_exist)
                    <li class="nav-item nav-category">SDM Menu</li>
                    <x-sidebar-menu></x-sidebar-menu>
                    @endif

                    <li class="nav-item nav-category">Auth</li>
                    <li class="nav-item">
                        <a href="{{ route('auth.change-password') }}" class="nav-link">
                            <i class="link-icon" data-feather="settings"></i>
                            <span class="link-title">Ubah password</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="link-icon" data-feather="log-out"></i>
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
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    @yield('plugin_js')
    @yield('custom_js')
</body>


</html>