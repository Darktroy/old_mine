<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/panel') }}" class="site_title"><i class="fa fa-paw"></i>
                <span>{{ Auth::user()->name}}</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset(auth::user()->image) }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                    <li><a><i class="fa fa-cogs"></i> Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('/panel/admin/settings') }}">admin Settings</a></li>
                            <li><a href="{{ url('/panel/admin/site-config') }}"> Site Config </a></li>
                            <li>
                                <a>Our Sponsers <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/sponsers/') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/sponsers/new') }}">New Sponser</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a>
                            <i class="fa fa-home"></i> Home
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a>Home Slider<span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/home/slider') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/home/slider/new') }}">New Slide</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('panel/home/contact_us') }}">Contact Us Messages <span
                                            class="fa fa-comments"></span> </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a>
                            <i class="fa fa-edit"></i>
                            About Us
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a> Idea <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/about_us/idea') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/about_us/idea/new') }}">add</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a> Themes <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/about_us/themes') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/about_us/themes/new') }}">add</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a> Forums <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/about_us/forums') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/about_us/forums/new') }}">add</a>
                                    </li>
                                </ul>
                            </li>

                            <li><a href="{{ url('panel/about_us/geo') }}"> Geographic area </a></li>

                            <li>
                                <a> Social Labels <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/about_us/labels') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/about_us/labels/new') }}">add</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> FAQ <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('panel/faq') }}">List All</a></li>
                            <li><a href="{{ url('panel/faq/new') }}">New Question</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Blog <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a> Categories <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/blog/categories') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/blog/categories/new') }}">add</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a> Posts <span class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu">
                                        <a href="{{ url('panel/blog/posts') }}">List All</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('panel/blog/posts/new') }}">add</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ url('panel/blog/comments') }}">Comments</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('panel/countries') }}">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            Countries
                        </a>
                    </li>


                    <li><a> <i class="fa fa-globe" aria-hidden="true"></i> Cities <span
                                    class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ url('panel/cities') }}">
                                    List All
                                </a>
                            </li>
                            <li><a href="{{ url('panel/cities/new') }}">New </a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-phone" aria-hidden="true"></i>Calls <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('panel/calls') }}">List all</a></li>
                            <li><a href="{{ url('panel/calls/new') }}">New Call</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-registered" aria-hidden="true"></i>Offers <span
                                    class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ url('panel/offers/') }}">List All</a></li>
                            <li><a href="{{ url('panel/offers/new') }}">New Offer</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-phone" aria-hidden="true"></i>Applications <span
                                    class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a><i class="fa fa-phone" aria-hidden="true"></i>Countries <span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('panel/application/index') }}"> index </a></li>
                                    </li>
                                    <li><a href="{{ url('invite/invite-app') }}"> NEw </a></li>
                                </ul>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>