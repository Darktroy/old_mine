<div class="header-lower">
    <div class="page-container reset clearfix">
        <!--Logo-->
        <div class="logo"><a href="{{ url('/') }}">
                <img src="{{ asset(\App\Models\SiteConfig::getValueByKey('logo')) }}" alt="Volunteer" title="Volunteer">
            </a>
        </div>

        <!--Right Container-->
        <div class="right-cont clearfix">

            <!-- Main Menu -->
            <nav class="main-menu">
                <div class="navbar-header">
                    <!-- Toggle Button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div class="navbar-collapse collapse clearfix">
                    <ul class="navigation">
                        <li class="current"><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="dropdown"><a href="#">About Us</a>
                            <ul class="submenu">
                                <li><a href="{{ url('about-us/idea') }}">Idea</a></li>
                                <li><a href="{{ url('about-us/themes') }}">Themes</a></li>
                                <li><a href="{{ url('about-us/geolocation') }}">Geographic area</a></li>
                                <li><a href="faq.html">Coordinators</a></li>
                                <li><a href="faq.html">Advisory Board</a></li>
                                <li><a href="{{ url('about-us/label') }}">Social Label</a></li>
                                <li><a href="{{ url('about-us/forums') }}">Forum</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#">how it works</a>
                        </li>
                        <li class="dropdown"><a href="{{ url('countries') }}">Euro-Med</a></li>
                        <li class="dropdown">
                            <a href="">Change Makers</a>
                            <ul class="submenu">
                                <li><a href="{{ url('/changemakers/register') }}">Registration</a></li>
                                <li><a href="single-causes.html">Benefits</a></li>
                                <li><a href="single-causes.html">Voluntary Hour Program</a></li>
                                <li><a href="{{ url('/calls') }}">Calls</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="event.html">Companies</a>
                            <ul class="submenu">
                                <li><a href="{{ url('company/register') }}">Registration</a></li>
                                <li><a href="single-event.html">Benefits</a></li>
                                <li><a href="{{ url('/offers') }}">Offers</a></li>
                                @if(Auth::check() && Auth::user()->type != 3 )
                                    <li><a href="single-event.html">Add an Offer</a></li>
                                @endif
                                @if(Auth::check() && Auth::user()->type != 3 )
                                    <li><a href="single-event.html">Add a Call</a></li>
                                @endif
                                <li><a href="single-event.html">CSR</a></li>
                                <li><a href="single-event.html">Fees</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="contact.html">Partners</a>
                            <ul class="submenu from-left">
                                <li><a href="{{ url('partners/register') }}">Registration</a></li>
                                <li><a href="{{ url('partner/benefits') }}">Benefits</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="#">Register As</a>
                            <ul class="submenu">
                                <li><a href="{{ url('/changemakers/register') }}">Register As Change-Maker</a></li>
                                <li><a href="{{ url('invite/invite-app') }}">Register As National Organization</a>
                                </li>
                                <li><a href="{{ url('company/register') }}">Register As Company</a>
                                </li>
                                <li><a href="{{ url('partners/register') }}">Register As Partner</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="{{ url('/faq') }}">FAQ</a>
                            <ul class="submenu">
                                <li class="dropdown">
                                    <a href="">Registration</a>
                                    <ul class="submenu">
                                        <li><a href="{{ url('/faq/r_m') }}">Change Makers</a></li>
                                        <li><a href="{{ url('/faq/r_c') }}">Companies</a></li>
                                        <li><a href="{{ url('/faq/r_p') }}">Partners</a></li>
                                        <li><a href="{{ url('/faq/r_o') }}">Public Organizations</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('/faq/l') }}">Social Label</a></li>
                                <li><a href="{{ url('/faq/f') }}">Fees</a></li>
                                <li><a href="{{ url('/faq/d') }}">Donation</a></li>
                                <li><a href="{{ url('/faq/g') }}">general</a></li>

                            </ul>
                        </li>

                        <li class="dropdown"><a href="{{ url('/blog/posts') }}">Blog</a></li>
                    </ul>
                </div>
            </nav>
            <!-- Main Menu End-->
        </div>

    </div>

</div>