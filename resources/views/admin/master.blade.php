<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PizzaOnline : Restaurant Admin Template" />
    <meta property="og:title" content="PizzaOnline : Restaurant Admin Template" />
    <meta property="og:description" content="PizzaOnline : Restaurant Admin Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <title>{{env('APP_NAME')}} | @yield('title')</title>

    @include('admin.layout.header-links')
    @stack('style-link')
    @yield('style')
    @stack('style')
</head>
<body>
<!--*******************
    Preloader start
********************-->
@include('admin.layout.loader')
<!--*******************
    Preloader end
********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">
    @include('admin.layout.header')

    @include('admin.layout.sidebar')


    <!--**********************************
        Content body start
    ***********************************-->
    @yield('main')
    <!--**********************************
        Content body end
    ***********************************-->



    <!--**********************************
        Footer start
    ***********************************-->
    @include('admin.layout.footer')
    <!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->

</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
@include('admin.layout.footer-links')
@stack('script-link')
@yield('js')
@stack('script')
</body>

</html>
