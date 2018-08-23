@extends('layouts.site.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}"> @stop
@section('limitless')
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('site/limitless/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css"> {{--
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css"> --}}
    <link href="{{ asset('site/limitless/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('site/limitless/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('site/limitless/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/core/libraries/jquery.min.js') }}"></script>
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
            {{--@if(!empty(auth()->user()))--}}
            {{--<a href="#" class="active">{{ $user->name }}</a>--}}
            {{--@endif--}}
            {{--@else--}}
            <a href="{{ url('countries/country/'.$country->id) }}" class="active">{{ $country->name }}</a>&ensp;
            {{--@if(isset($events))--}}
            {{--<span class="fa fa-angle-right"></span>&ensp;--}}
            {{--<a href="{{ url($url.$filterBy) }}" class="active">{{ $events }}</a>&ensp;--}}
            {{--@endif--}}
            @if(isset($list))
                <span class="fa fa-angle-right"></span>&ensp;
                <a href="{{ url($url.$filterBy) }}" class="active">{{ $list }}</a>&ensp;
            @endif
            @if(isset($new))
                <span class="fa fa-angle-right"></span>&ensp;
                <a href="#" class="active">{{ $new }}</a>&ensp;
            @endif
            @if(isset($edit))
                <span class="fa fa-angle-right"></span>&ensp;
                <a href="#" class="active">{{ $edit }}</a>&ensp;
            @endif
        </div>
    </div>
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
        {{-- @include('layouts.limitless.sidebar') --}}
        <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Toolbar -->
                <div class="navbar navbar-default navbar-component navbar-xs">
                    <ul class="nav navbar-nav visible-xs-block">
                        <li class="full-width text-center">
                            <a data-toggle="collapse" data-target="#navbar-filter">
                                <i class="icon-menu7"></i>
                            </a>
                        </li>
                    </ul>

                    <div class="navbar-collapse collapse" id="navbar-filter">
                        <ul class="nav navbar-nav">
                            @foreach($links as $k => $link)
                                <li class="{{ $link['status'] }}">
                                    <a href="{{ $link['url'] }}">
                                        <i class="{{ $link['icon'] }} position-left"></i> {{ $link['name'] }}</a>
                                </li>
                            @endforeach {{--
						<li class="active">
							<a href="#settings" data-toggle="tab">
								<i class="icon-cog3 position-left"></i> Settings</a>
						</li>--}}
                        </ul>

                        {{--
                        <div class="navbar-right">--}} {{--
						<ul class="nav navbar-nav">--}} {{--
							<li>
								<a href="#">
									<i class="icon-stack-text position-left"></i> Notes</a>
							</li>--}} {{--
							<li>
								<a href="#">
									<i class="icon-collaboration position-left"></i> Friends</a>
							</li>--}} {{--
							<li>
								<a href="#">
									<i class="icon-images3 position-left"></i> Photos</a>
							</li>--}} {{--
						</ul>--}} {{--
					</div>--}}
                    </div>
                </div>
                <!-- /toolbar -->


                <!-- User profile -->
                <div class="row">
                    <div class="col-lg-9">
                        <div class="tabbable">
                            <div class="tab-content">
                                <div id="settings">
                                    @yield('country_account')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">

                    @if(!empty(auth()->user()))
                        <!-- User thumbnail -->
                            <div class="thumbnail">
                                <div class="thumb thumb-rounded thumb-slide">
                                    <img src="{{ asset('media/flags/'.$user->country->flag) }}" alt="">
                                </div>

                                <div class="caption text-center">
                                    <h6 class="text-semibold no-margin">{{ $user->name }} </h6>
                                </div>
                                @if(isset($country_admin) && $country_admin)
                                    <div class="caption text-center">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false">
                                                <span class="glyphicon glyphicon-bell"></span> Notifications <span
                                                        class="caret">{{ count(auth()->user()->unreadNotifications) }}</span>
                                            </a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                                        <a href="#"> {{" you ".$notification['data']['message'] }} </a>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </li>
                                        {{--<h6 class="text-semibold no-margin"><a> Notifications </a></h6>--}}
                                    </div>
                                @endif
                            </div>
                            <!-- /user thumbnail -->
                    @endif
                    <!-- Navigation -->
                        <div class="panel panel-flat">
                            {{--<div class="panel-heading">--}}
                            {{--<h6 class="panel-title">Navigation</h6>--}}
                            {{--</div>--}}

                            <div class="list-group no-border no-padding-top">
                                @if(!empty(auth()->user()) && $position ==1)
                                    @if(auth()->user()->type == 1)
                                        <a href="{{ url('/country/account') }}" class="list-group-item">
                                            <i class="icon-cog3">
                                            </i> Account settings
                                        </a>

                                        <a href="{{ url ('invite/invitations') }}" class="list-group-item">
                                            <i class="icon-envelop2"></i> Invite
                                        </a>
                                        <a href="{{ url('/country/users/'.$filterBy) }}" class="list-group-item">
                                            <i class="icon-users4"></i>
                                            Sub Users
                                        </a>
                                        <?php $role_permission = new \App\Http\Controllers\RoleController(); $country = auth()->user()->country->id; ?>
                                        @if(is_bool($role_permission->checkRolePermission("show_followers")))
                                            <a href="{{ url('country/follow/index/'.$country ) }}"
                                               class="list-group-item">
                                                <i class="fa fa-user-secret"></i>
                                                Followers
                                            </a>
                                        @endif

                                        <div class="list-group-divider"></div>
                                    @endif
                                @endif

                                <a href="{{ url('country/events/'.$filterBy) }}"
                                   class="list-group-item">
                                    <i class="icon-calendar3"></i> Events
                                </a>

                                <a href="{{ url('country/agreements/'.$filterBy) }}"
                                   class="list-group-item">
                                    <i class="fa fa-chain"></i> Agreements
                                </a>

                                <a href="{{ url('country/topics/'.$filterBy) }}"
                                   class="list-group-item">
                                    <i class="icon-pen-plus"></i> Topics
                                </a>

                                <a href="{{ url('country/news/'.$filterBy) }}"
                                   class="list-group-item">
                                    <i class="icon-megaphone"></i> News
                                </a>

                                <a href="{{ url('country/calls/'.$filterBy) }}" class="list-group-item">
                                    <i class="icon-phone2"></i>Calls
                                </a>

                                <a href="{{ url('country/offers/'.$filterBy) }}" class="list-group-item">
                                    <i class="fa fa-registered"></i> Offers
                                </a>

                                <a href="{{ url('country/organization/index/'.$filterBy) }}"
                                   class="list-group-item">
                                    <i class="glyphicon glyphicon-globe"></i> National Organizations
                                </a>

                            </div>
                        </div>
                        <!-- /navigation -->
                        @if(!empty(auth()->user()))
                            @if(auth()->user()->type === 1 )
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Latest connections</h6>
                                        <div class="heading-elements">
                                            <span class="badge badge-success heading-text">+32</span>
                                        </div>
                                    </div>

                                    <ul class="media-list media-list-linked pb-5">
                                        <li class="media-header">Office staff</li>

                                        <li class="media">
                                            <a href="#" class="media-link">
                                                <div class="media-left">
                                                    <img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <span class="media-heading text-semibold">James Alexander</span>
                                                    <span class="media-annotation">UI/UX expert</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <span class="status-mark bg-success"></span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="media">
                                            <a href="#" class="media-link">
                                                <div class="media-left">
                                                    <img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <span class="media-heading text-semibold">Jeremy Victorino</span>
                                                    <span class="media-annotation">Senior designer</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <span class="status-mark bg-danger"></span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="media">
                                            <a href="#" class="media-link">
                                                <div class="media-left">
                                                    <img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <span class="text-semibold">Jordana Mills</span>
                                                    </div>
                                                    <span class="text-muted">Sales consultant</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <span class="status-mark bg-grey-300"></span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="media">
                                            <a href="#" class="media-link">
                                                <div class="media-left">
                                                    <img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <div class="media-heading">
                                                        <span class="text-semibold">William Miles</span>
                                                    </div>
                                                    <span class="text-muted">SEO expert</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <span class="status-mark bg-success"></span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="media-header">Partners</li>

                                        <li class="media">
                                            <a href="#" class="media-link">
                                                <div class="media-left">
                                                    <img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <span class="media-heading text-semibold">Margo Baker</span>
                                                    <span class="media-annotation">Google</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <span class="status-mark bg-success"></span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="media">
                                            <a href="#" class="media-link">
                                                <div class="media-left">
                                                    <img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <span class="media-heading text-semibold">Beatrix Diaz</span>
                                                    <span class="media-annotation">Facebook</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <span class="status-mark bg-warning-400"></span>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="media">
                                            <a href="#" class="media-link">
                                                <div class="media-left">
                                                    <img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <span class="media-heading text-semibold">Richard Vango</span>
                                                    <span class="media-annotation">Microsoft</span>
                                                </div>
                                                <div class="media-right media-middle">
                                                    <span class="status-mark bg-grey-300"></span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
                <!-- /user profile -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

    {{--@include('site.paralex')--}}
    @include('site.sponser')
    @include('common.invite_email_modal')
@stop
@section('limitless_scripts')
    <!-- Theme JS files -->
    {{--
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/forms/selects/select2.min.js') }}"></script> --}}
    <script type="text/javascript"
            src="{{ asset('site/limitless/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    {{--
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/ui/moment/moment.min.js') }}"></script> --}} {{--
<script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/ui/fullcalendar/fullcalendar.min.js') }}"></script> --}} {{--
<script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/visualization/echarts/echarts.js') }}"></script> --}}

    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/plugins/ui/drilldown.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site/limitless/assets/js/pages/user_pages_profile.js') }}"></script>
    <script type="text/javascript" src="{{ asset('site/js/change_maker.js') }}"></script>

    <script type="text/javascript">
        var url = $('.list-group a[href="' + window.location.href + '"]');
        $('.list-group a[href="' + window.location.href + '"]').addClass('active');
    </script>

@stop