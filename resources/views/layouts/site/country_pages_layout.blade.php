@extends('layouts.site.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('limitless')
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

    <!-- Core JS files -->
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/plugins/loaders/blockui.min.js') }}"></script>

    <!-- /core JS files -->
@stop
@section('content')
    <!--Bread Crumb-->
    <div class="bread-crumb">
        <div class="page-container reset">
            {{ $parent_title }}   &ensp;<span class="fa fa-angle-right"></span>&ensp; <a href="#"
                                                                                         class="ative">{{ $page_title }}</a>
        </div>
    </div>
    <!-- Page container -->
    <div class="page-container reset">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
                <br>
                @yield('page_content')

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

    @include('site.sponser')
@stop
@section('limitless_scripts')
    <!-- Theme JS files -->
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/plugins/ui/drilldown.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/core/app.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/pages/user_pages_profile.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('site/js/change_maker.js') }}"></script>--}}

@stop
