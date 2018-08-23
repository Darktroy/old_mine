<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Volunteer Multipurpose HTML5 Donation Template | Home Page Style One</title>
    <!-- Stylesheets -->
    <link href="{{ asset('site/limitless/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('site/css/revolution-slider.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    @yield('styles')
    {{-- <link rel="stylesheet" href="{{ asset('site/css/tiger_style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('site/css/main-style.css') }}">
    {{--  Limitless files  --}}
        <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('site/limitless/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet"
          type="text/css">
    {{-- <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('site/limitless/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('site/limitless/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('site/limitless/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    @yield('limitless')
    <link href="{{ asset('site/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/custom.css') }}">
{{-- <link href="{{ asset('site/limitless/assets/css/core.css') }}" rel="stylesheet" type="text/css"> --}}
{{-- <link href="{{ asset('site/limitless/assets/css/components.css') }}" rel="stylesheet" type="text/css"> --}}
{{-- <link href="{{ asset('site/limitless/assets/css/colors.css') }}" rel="stylesheet" type="text/css"> --}}

<!--<link rel="stylesheet" href="css/owl.carousel.css">-->

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
<script src="{{ asset('site/js/wow.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('site/js/plugins/footable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('panel-assets/tinymce/tinymce.min.js') }}"></script>
@yield('page_scripts')
<script src="{{ asset('site/js/animationCounter.min.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="{{ asset('site/js/jquery.noty.packaged.min.js') }}"></script>
<script src="{{ asset('site/js/script.min.js') }}"></script>
<script src="{{ asset('js/errors.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('site/limitless/assets/js/plugins/ui/nicescroll.min.js') }}"></script>
{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjY_I0RMscc81vSHs8NX6RToEuu4Nh75s&callback=initMap"></script> --}}

<script>
    var url = $('.nav li a[href="' + window.location.href + '"]');
    $('.nav li a[href="' + window.location.href + '"]').parent('li').addClass('active');
</script>
@yield('scripts')
@yield('limitless_scripts')
</body>
</html>
