<!DOCTYPE html>
<html lang="en"
    dir="ltr"
    data-nav-layout="vertical"
    data-vertical-style="overlay"
    data-theme-mode="light"
    data-header-styles="light"
    data-menu-styles="light"
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
    <script src="/assets/libraries/ynex/js/authentication-main.js"></script>

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

        <!-- Custom.me Css -->
        <link href="/assets/libraries/custom/css/style.css"
        rel="stylesheet">

</head>

<body>

    @yield('content')

    <!-- Jquery JS -->
    <script src="/assets/libraries/jquery/jquery-3.7.0.min.js"></script>
    <script src="/assets/libraries/jquery/jquery.blockUI.js"></script>

    <!-- Bootstrap JS -->
    <script src="/assets/libraries/ynex/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Show Password JS -->
    <script src="/assets/libraries/ynex/js/show-password.js"></script>

    <!-- Custom.me JS -->
    <script src="/assets/libraries/custom/js/script.js"></script>

</body>

</html>
