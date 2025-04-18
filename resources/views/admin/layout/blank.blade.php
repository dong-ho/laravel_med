<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{assert('admin=assets')}}"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin Dashboard</title>

    <meta name="description" content="Admin Dashboard" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin-assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- custom css -->
    @yield('css')

    <!-- Helpers -->
    <script src="{{ asset('admin-assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin-assets/js/config.js')}}"></script>
</head>

<body>
<!-- Layout wrapper -->
@yield('contents')
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js admin-assets/vendor/js/core.js -->

<script src="{{ asset('admin-assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Main JS -->
<script src="{{ asset('admin-assets/js/main.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- custom js -->
@yield('script')

</body>
</html>
