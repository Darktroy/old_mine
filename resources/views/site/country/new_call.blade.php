@extends('layouts.site.country')
@section('country_account')
            <!--Bread Crumb-->
    <div class="bread-crumb">
        <div class="auto-container">
            Country  &ensp;<span class="fa fa-angle-right"></span>&ensp; <a href="#" class="ative">Login</a>
        </div>
    </div>

    <div class="account">
        <div class="auto-container">
            <div class="row clearfix">
                @include('layouts.site.country_sidebar')
                <div class="col-lg-9 col-md-8 col-xs-12">
                    @include('errors.list')
                    @if(Session::has('message'))
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                            </button>
                            {{ session('message') }}
                        </div>
                    @endif
                    @include('common.calls_form')
                </div>
            </div>
        </div>
    </div>

        @include('site.paralex')
    @include('site.sponser')
@stop