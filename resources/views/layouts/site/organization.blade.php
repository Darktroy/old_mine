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
    @if(isset($position) && $position ==2 )
        <?php $filterBy = $country_id . '/' . $position; ?>
    @else
        <?php  $filterBy = auth()->user()->id . '/' . $position; ?>
    @endif
    <!--Bread Crumb-->
    <div class="bread-crumb">
        <div class="page-container reset">
            <a href="{{url('countries')}}">Countries</a> &ensp;
            <span class="fa fa-angle-right"></span>&ensp;
            <a href="{{ url('countries/country/'.$country->id) }}" class="active">{{ $country->name }}</a>&ensp;
            @if(isset($list))
                <span class="fa fa-angle-right"></span>&ensp;
                <a href="{{ url($url.$filterBy) }}" class="active">{{ $list }}</a>&ensp;
                @endif
                {{--<span class="fa fa-angle-right"></span>&ensp;--}}
                {{--<a href="{{url('countries')}}" class="ative"> {{ $parent_title }} </a>--}}
                &ensp;
                <span class="fa fa-angle-right"></span>&ensp;
                <a href="{{url('country/organization/index/'.$country_id.'/'.$position)}}"
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

    @include('site.paralex')
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