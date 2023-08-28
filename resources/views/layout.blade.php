@php $crud_routes = ['users', 'products', 'categories', 'colors', 'brands', 'tags']; @endphp

<!DOCTYPE html>
<html lang="en"
    dir="ltr"
    data-nav-layout="vertical"
    data-theme-mode="light"
    data-header-styles="light"
    data-menu-styles="dark"
    data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport'
        content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible"
        content="IE=edge">
    <title> {{ $title }} - Myecommerce</title>
    <meta name="Description"
        content="">
    <meta name="Author"
        content="DarmaCodes">
    <meta name="keywords"
        content="">

    <!-- Favicon -->
    <link rel="icon"
        href="/assets/images/global/favicon.ico"
        type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="/assets/libraries/ynex/js/main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style"
        href="/assets/libraries/ynex/libs/bootstrap/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Style Css -->
    <link href="/assets/libraries/ynex/css/styles.min.css"
        rel="stylesheet">

    <!-- Icons Css -->
    <link href="/assets/libraries/ynex/css/icons.min.css"
        rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="/assets/libraries/ynex/libs/node-waves/waves.min.css"
        rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="/assets/libraries/ynex/libs/simplebar/simplebar.min.css"
        rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet"
        href="/assets/libraries/ynex/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet"
        href="/assets/libraries/ynex/libs/@simonwep/pickr/themes/nano.min.css">

    @if (in_array(request()->path(), $crud_routes))
        <!-- DataTables Cdn -->
        <link rel="stylesheet"
            href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet"
            href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet"
            href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    @endif

    {{-- @if (Str::contains(request()->path('products'), ['/create', '/edit']))
    @endif --}}

    {{-- @if (request()->is('products*'))
    @endif --}}

    <!-- Custom.me Css -->
    <link href="/assets/libraries/custom/css/style.css"
        rel="stylesheet">

</head>

<body>
    <!-- Start Switcher -->
    @include('switcher')
    <!-- End Switcher -->

    <!-- Loader -->
    <div id="loader">
        <img src="/assets/libraries/ynex/images/media/loader.svg"
            alt="">
    </div>
    <!-- Loader -->

    <div class="page">

        <!-- app-header -->
        @include('header')
        <!-- /app-header -->

        <!-- Start::app-sidebar -->
        @include('aside')
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                @yield('main')

            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer Start -->
        @include('footer')
        <!-- Footer End -->

    </div>

    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Jquery JS -->
    <script src="/assets/libraries/jquery/jquery-3.7.0.min.js"></script>
    <script src="/assets/libraries/jquery/jquery.blockUI.js"></script>

    <!-- Popper JS -->
    <script src="/assets/libraries/ynex/libs/@popperjs/core/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="/assets/libraries/ynex/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Show Password JS -->
    <script src="/assets/libraries/ynex/js/show-password.js"></script>

    <!-- Defaultmenu JS -->
    <script src="/assets/libraries/ynex/js/defaultmenu.min.js"></script>

    <!-- Node Waves JS-->
    <script src="/assets/libraries/ynex/libs/node-waves/waves.min.js"></script>

    <!-- Simplebar JS -->
    <script src="/assets/libraries/ynex/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libraries/ynex/js/simplebar.js"></script>

    <!-- Color Picker JS -->
    <script src="/assets/libraries/ynex/libs/@simonwep/pickr/pickr.es5.min.js"></script>

    <!-- Custom-Switcher JS -->
    <script src="/assets/libraries/ynex/js/custom-switcher.min.js"></script>

    <!-- Custom JS -->
    <script src="/assets/libraries/ynex/js/custom.js"></script>

    @if (in_array(request()->path(), $crud_routes))
        <!-- DataTables Cdn JS -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

        <!-- Internal Datatables JS -->
        <script src="/assets/libraries/ynex/js/datatables.js"></script>
    @endif

    {{-- @if (Str::contains(request()->path('products'), ['/create', '/edit']))
    @endif --}}

    {{-- @if (request()->is('products*'))
    @endif --}}

    <!-- Toast JS -->
    <script src="/assets/libraries/ynex/js/Toasts.js"></script>

    <!-- Custom.me JS -->
    <script src="/assets/libraries/custom/js/script.js"></script>

</body>

</html>
