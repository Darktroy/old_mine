<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Volunteer Multipurpose HTML5 Donation Template | Home Page Style One</title>
    <!-- Stylesheets -->
    <link href="{{ asset('site/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/revolution-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('site/css/custom.css') }}">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="{{ asset('site/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]>
    <script src="js/respond.js"></script><![endif]-->
</head>

<body>
<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header -->
    @include('layouts.site.includes.header')
    <example></example>
    <!--Sidebar Navigation-->
    @include('layouts.site.includes.side_bar')

<!-- Content -->
    @yield('content')

<!--Main Footer-->
    @include('layouts.site.includes.footer')

</div>
<!--End pagewrapper-->
<!--Scroll to top-->
<div class="scroll-to-top"><span class="fa fa-arrow-up"></span></div>


<script src="{{ asset('site/js/jquery.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/js/rev-plugins.min.js') }}"></script>
<script src="{{ asset('site/js/revolution.min.js') }}"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('site/js/fitvids.min.js') }}"></script>
<script src="{{ asset('site/js/jquery-parallax.min.js') }}"></script>
<script src="{{ asset('site/js/scrollbar.min.js') }}"></script>
<script src="{{ asset('site/js/validate.min.js') }}"></script>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ asset('site/js/googlemaps.min.js') }}"></script>
<script src="{{ asset('site/js/wow.min.js') }}"></script>
<script src="{{ asset('js/errors.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="{{ asset('site/js/jquery.noty.packaged.min.js') }}"></script>
<script src="{{ asset('site/js/script.min.js') }}"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>


</body>
</html>