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
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

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
    <link rel="stylesheet"
        href="{{ asset('/themeforest/NobleUI/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet"
        href="{{ asset('/themeforest/NobleUI/template/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet"
        href="{{ asset('/themeforest/NobleUI/template/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('/themeforest/NobleUI/template/assets/css/demo1/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('/themeforest/NobleUI/template/assets/images/favicon.png') }}" />
    @vite('resources/js/app.js')
</head>

<body>
    <div class="main-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @include('partials.sidebar')
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:../../partials/_navbar.html -->
            @include('partials.navbar')
            <!-- partial -->

            <div class="page-content">
                @yield('content')
            </div>

            <!-- partial:../../partials/_footer.html -->
            <footer
                class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="https://www.nobleui.com"
                        target="_blank">NobleUI</a>.</p>
                <p class="text-muted">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm"
                        data-feather="heart"></i></p>
            </footer>
            <!-- partial -->

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
