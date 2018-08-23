<!--Header Top-->


<div class="header-top">
    <div class="page-container reset">
        <div class="row">
            <!--Top Left-->
            <div class="col-md-6 col-sm-6 col-xs-12 top-left">
                <div class="clearfix">
                    <div class="pull-left phone-num">
                        <span class="icon flaticon-telephone51"></span>
                        Call us : <a href="#">{{ \App\Models\SiteConfig::getValueByKey('phone') }}</a>
                    </div>
                    <div class="pull-left email">
                        <span class="icon flaticon-mail115"></span>
                        Send email :
                        <a href="{{ \App\Models\SiteConfig::getValueByKey('email') }}">
                            {{ \App\Models\SiteConfig::getValueByKey('email') }}
                        </a>
                    </div>
                </div>
            </div>
            <!--Top Right-->
            <div class="col-md-6 col-sm-6 col-xs-12 top-right">
                @if(Auth::check() === true)
                    <a href="{{ url('/logout') }}" style="margin-right:10px;">Logout</a>
                    @if(Auth::user()->type == 1)
                        <a href="{{ url('/country/account') }}">Account</a>
                    @elseif(Auth::user()->type == 2)
                        <a href="{{ url('/company/account') }}">Account</a>
                    @elseif(Auth::user()->type == 3)
                        <a href="{{ url('/changemaker/account') }}">Account</a>
                    @elseif(Auth::user()->type == 4)
                        <a href="{{ url('/country/account/'.Auth::user()->id) }}">Account</a>
                    @elseif(Auth::user()->type == 0)
                        <a href="{{ url('/panel') }}">Account</a>
                    @endif
                @else
                    <a href="{{ url('user/login') }}">login</a>
                @endif
            </div>

        </div>
    </div>
</div>