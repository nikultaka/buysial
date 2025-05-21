<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('admin-title')</title>


    <meta name="description" content="" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/admin/theme/vendor/fonts/boxicons.css') }}" />

    {{-- favicon --}}
    <link rel="shortcut icon" sizes="114x114" href="{{ asset('assets/frontend/images/favicon.png') }}">

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
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/admin/theme/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/admin/theme/js/config.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script> --}}

    {{-- bootstrap icon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">

    {{-- intlTelInput --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/21.2.4/css/intlTelInput.css" integrity="sha512-xfRW7rjTXkTHHRfKI9tk9v2oFHnR8vlctaqGskc/M3+SxEeLvlfsOuMV2/h3hTNrXzmRd7fXV4q9pWTrGz1qaw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('admin.layouts.sidebar')
            <!-- Layout container -->
            <div class="layout-page">

                @include('admin.layouts.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div id="loader-container">
                        <div class="loader"></div>
                    </div>
                    @yield('admin-content')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

    </div>


    {{-- <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form> --}}
    <script type="text/javascript">
        var BASE_URL = "{{ url('/') }}";

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/admin/theme/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.js" integrity="sha512-E/kDI3wGWMS9Ea/EsDJMduyGSSx/VfdNXAMr/URDQwOAGkGn3uYaZa4Y7bim3ad/6mMA82l+9FxNWl64BR9pkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css" integrity="sha512-WVPV4X/HI/9wClnD+CxFC0qSDE7blZgqZQLjrnEXQUhkm0nkDcoux3ysgIb3oG74MEHobuvEQg7W3XvZK9ZC/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('assets/admin/theme/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/theme/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/theme/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script>
        function showLoader() {
            $("#loader-overlay").fadeIn();
        }

        // Hide Loader function
        function hideLoader() {
            $("#loader-overlay").fadeOut();
        }

        $(document).ready(function() {

            $('#loader-container').hide();
            setTimeout(hideLoader, 3000);

        });
    </script>
    {{-- ckeditor 4 --}}
    {{-- <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

    <script src="{{ asset('assets/admin/theme/cdnFiles/validate.min.js') }}"></script>
    <script src="{{ asset('assets/admin/theme/cdnFiles/additional-methods.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/theme/vendor/libs/dataTables/jquery.dataTables.min.css') }}" />
    <script src="{{ asset('assets/admin/theme/vendor/libs/dataTables/jquery.dataTables.min.js') }}"></script> --}}

    <script src="{{ asset('assets/admin/theme/cdnFiles/ckeditor.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/admin/theme/cdnFiles/toastr.css') }}" />

    <script src="{{ asset('assets/admin/theme/cdnFiles/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/admin/theme/vendor/js/menu.js') }} "></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('assets/admin/theme/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    @yield('admin-footer')
    <!-- Main JS -->
    <script src="{{ asset('assets/admin/theme/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/admin/theme/js/dashboards-analytics.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
