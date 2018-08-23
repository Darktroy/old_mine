@extends('layouts.site.inner_pages_layout')
@section('page_content')
    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-component navbar-xs">
        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i
                            class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                @foreach($links as $k => $link)
                    <li class="{{ $link['status'] }}">
                        <a href="{{ $link['url'] }}"><i class="{{ $link['icon'] }} position-left"></i> {{ $link['name'] }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li><a href="#"><i class="icon-stack-text position-left"></i> Notes</a></li>
                    <li><a href="#"><i class="icon-collaboration position-left"></i> Friends</a></li>
                    <li><a href="#"><i class="icon-images3 position-left"></i> Photos</a></li>
                    {{-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gear"></i> <span class="visible-xs-inline-block position-right"> Options</span> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#"><i class="icon-image2"></i> Update cover</a></li>
                            <li><a href="#"><i class="icon-clippy"></i> Update info</a></li>
                            <li><a href="#"><i class="icon-make-group"></i> Manage sections</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-three-bars"></i> Activity log</a></li>
                            <li><a href="#"><i class="icon-cog5"></i> Profile settings</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <!-- /toolbar -->


    <!-- User profile -->
    <div class="row">
        <div class="col-lg-9">
            <div class="tabbable">
                <div class="tab-content">
                    <div id="">

                        @yield('profile_pages')

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">

            <!-- User thumbnail -->
            <div class="thumbnail">
                <div class="thumb thumb-rounded thumb-slide">
                    <img src="{{ asset('media/profile/'.$user->image) }}" alt="">
                    <div class="caption">
									<span>
										<a href="#" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i
                                                    class="icon-plus2"></i></a>
										<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs"><i
                                                    class="icon-link"></i></a>
									</span>
                    </div>
                </div>

                <div class="caption text-center">
                    <h6 class="text-semibold no-margin">{{ $user->name }}
                        <small class="display-block">UX/UI designer</small>
                    </h6>
                    <ul class="icons-list mt-15">
                        <li><a href="#" data-popup="tooltip" title="Google Drive"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#" data-popup="tooltip" title="Twitter"><i class="icon-facebook"></i></a></li>

                    </ul>
                </div>
            </div>
            <!-- /user thumbnail -->

            <!-- Navigation -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Navigation</h6>
                    <div class="heading-elements">
                        <a href="#" class="heading-text">See all &rarr;</a>
                    </div>
                </div>

                <div class="list-group no-border no-padding-top">
                    <a href="{{ url('/company/account') }}" class="list-group-item"><i class="icon-cog3"></i>
                        Account settings</a>
                    <a href="#" class="list-group-item"><i class="icon-envelop2"></i> Invite Friend</a>
                    <a href="{{ url('/company/connections') }}" class="list-group-item"><i class="icon-users"></i>
                        Connections <span class="badge bg-danger pull-right">29</span></a>
                    <a href="{{ url('/company/gallery') }}" class="list-group-item"><i class="icon-film"></i>
                        Gallery</a>
                    <div class="list-group-divider"></div>
                    <a href="{{ url('/company/events') }}" class="list-group-item"><i class="icon-calendar3"></i>
                        Events <span class="badge bg-teal-400 pull-right">48</span></a>
                    <a href="{{ url('/company/topics') }}" class="list-group-item"><i class="icon-pen-plus"></i>
                        Topics <span class="badge bg-teal-400 pull-right">48</span></a>
                    <div class="list-group-divider"></div>
                    <a href="{{ url('/company/calls') }}" class="list-group-item"><i class="icon-phone2"></i>
                        Calls</a>
                    <a href="{{ url('/company/offers') }}" class="list-group-item"><i class="fa fa-registered"></i>
                        Offers</a>

                </div>
            </div>
            <!-- /navigation -->

            <!-- Connections -->
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
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt="">
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
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt="">
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
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-heading"><span class="text-semibold">Jordana Mills</span></div>
                                <span class="text-muted">Sales consultant</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark bg-grey-300"></span>
                            </div>
                        </a>
                    </li>

                    <li class="media">
                        <a href="#" class="media-link">
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt="">
                            </div>
                            <div class="media-body">
                                <div class="media-heading"><span class="text-semibold">William Miles</span></div>
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
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt="">
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
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt="">
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
                            <div class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle" alt="">
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
            <!-- /connections -->

        </div>
    </div>
    <!-- /user profile -->
@stop
