<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'PalladiumHub') }}</title> --}}
    <title>@yield('admin-title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- boxicons --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/theme/vendor/fonts/boxicons.css') }}" />


    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/admin/theme/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/admin/theme/vendor/libs/apex-charts/apex-charts.css') }}" />

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css') }}"
        rel="stylesheet">
    <!-- Page CSS -->


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/theme/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/theme/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/theme/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/admin/theme/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/theme/vendor/libs/apex-charts/apex-charts.css') }}" />

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css') }}"
        rel="stylesheet">

    <!-- Helpers -->
    <script src="{{ asset('assets/admin/theme/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('../assets/admin/theme/js/config.js') }}"></script>


</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div style="height: 5%">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/admin/theme/img/logo/logopalladiumhub.png') }}" alt=""
                            srcset="">
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<script src="{{ asset('assets/admin/theme/cdnFiles/bootstrap.min.css') }}"></script>
<script src="{{ asset('assets/admin/theme/cdnFiles/jquery.min.js') }}">
    < script src = "{{ asset('assets/admin/theme/vendor/libs/popper/popper.js') }}" >
</script>
<script src="{{ asset('assets/admin/theme/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/admin/theme/vendor/js/menu.js') }}"></script>

<script src="{{ asset('assets/admin/theme/js/main.js') }}"></script>

<script src="{{ asset('assets/admin/theme/js/dashboards-analytics.js') }}"></script>


</html>
