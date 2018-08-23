<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Euromed Admin panel </title>

    <!-- Bootstrap -->
    <link href="{{ asset('panel-assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('panel-assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('panel-assets/css/nprogress.css') }}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('panel-assets/css/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

    <link href="{{ asset('panel-assets/css/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/pnotify.nonblock.css') }}" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/flat/green.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('panel-assets/css/magicsuggest-min.css') }}">

    <!-- Custom Theme Style -->
    <link href="{{ asset('panel-assets/css/custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('panel-assets/css/style.css') }}">
</head>

<body class="nav-md">
<div class="container body" id="app">
    <div class="main_container">
        @include('layouts.panel.sidebar')
        @include('layouts.panel.top_nav')
        <div class="right_col" role="main">
            <div class="">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.panel.footer')
</div>

<!-- jQuery -->
<script src="{{ asset('panel-assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('panel-assets/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('panel-assets/js/fastclick.min.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('panel-assets/js/nprogress.min.js') }}"></script>
<!-- Chart.js -->
<script src="{{asset('panel-assets/js/Chart.min.js')}}"></script>
<!-- jQuery Sparklines -->
<script src="{{ asset('panel-assets/js/jquery.sparkline.min.js') }}"></script>
<!-- Flot -->
<script src="{{ asset('panel-assets/js/jquery.flot.min.js') }}"></script>
<script src="{{ asset('panel-assets/js/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('panel-assets/js/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('panel-assets/js/jquery.flot.stack.min.js') }}"></script>
<script src="{{ asset('panel-assets/js/jquery.flot.resize.min.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ asset('panel-assets/js/jquery.flot.orderBars.min.js') }}"></script>
<script src="{{ asset('panel-assets/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('panel-assets/js/curvedLines.min.js') }}"></script>
<!-- DateJS -->
<script src="{{ asset('panel-assets/js/date.min.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('panel-assets/js/moment.min.js') }}"></script>
<script src="{{ asset('panel-assets/js/daterangepicker.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('panel-assets/js/icheck.min.js') }}"></script>

    <!-- morris.js -->
    <script src="{{ asset('panel-assets/js/raphael.min.js') }}"></script>
    <script src="{{ asset('panel-assets/js/morris.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('panel-assets/js/bootstrap-progressbar.min.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('panel-assets/js/custom.min.js') }}"></script>
<script src="{{ asset('js/errors.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('panel-assets/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('site/js/jquery.noty.packaged.min.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('panel-assets/js/script.js') }}"></script>
<script>


</script>
@yield('scripts')
</body>
</html>
