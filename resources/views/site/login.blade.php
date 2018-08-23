@extends('layouts.site.inner_pages_layout')
@section('page_content')

    <style>
        .site_login {
            display: table;
            width: 75%;
        }
    </style>

    <div class="site_login">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

        <div class="sec-title">
            <h2 class="text-center">Login </h2>
        </div>
        {!! Form::open(['url'=>'/login']) !!}
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email"> Email * </label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password"> Password * </label>
            <input type="password" name="password" class="form-control" id="">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            {{--<input type="submit" value="login" class="btn btn-default">--}}

            <button type="submit" class="btn btn-primary submit">
                Login
            </button>
            <a class="reset_pass pull-right" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
        </div>

        <div class="form-group reset_pass pull-right">
            <ul class="submenu">
                <li><i class="fa fa-chevron-right"></i>&emsp;<a href="{{ url('/changemakers/register') }}">Register
                        As
                        Change-Maker</a></li>
                <li><i class="fa fa-chevron-right"></i>&emsp;<a href="{{ url('invite/invite-app') }}">Register As
                        National Organization</a>
                </li>
                <li><i class="fa fa-chevron-right"></i>&emsp;<a href="{{ url('company/register') }}">Register As
                        Company</a>
                </li>
                <li><i class="fa fa-chevron-right"></i>&emsp;<a href="{{ url('partners/register') }}">Register As
                        Partner</a>
                </li>
            </ul>
        </div>

        {!! Form::close() !!}
    </div>

@stop
