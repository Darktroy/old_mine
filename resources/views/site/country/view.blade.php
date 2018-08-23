@extends('layouts.site.country')
@section('country_account')

    <div class="panel-body">
        <div class="row">
            <div class="col-md-10 topic_{{ $country->id }}">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div>
                            @if(auth()->user())
                                @if($country->user->id == auth()->user()->id)
                                    <?php $details = \App\Models\OrganizationDescription::where('login_email', auth()->user()->email)->with('organizations')->first(); ?>
                                    <img src="{{ ( isset($details->logo) && !empty($details->logo)) ? asset('media/files/'.$details->logo) : '' }}"
                                         alt="" class="img-responsive" width="15%" height="5%">
                                @else
                                    <img src="{{ ( isset($country->flag) && !empty($country->flag)) ? asset('media/flags/'.$country->flag) : '' }}"
                                         width="15%" height="5%" alt="" class="img-responsive">
                                @endif
                            @else
                                <img src="{{ ( isset($country->flag) && !empty($country->flag)) ? asset('media/flags/'.$country->flag) : '' }}"
                                     width="15%" height="5%" alt="" class="img-responsive">
                            @endif

                        </div>
                        <h5 class="text-semibold mb-5">
                            @if(auth()->user())
                                @if($country->user->id == auth()->user()->id)
                                    <a href="#" class="text-default">{{ $details->organizations->org_name}}</a>
                                @else
                                    <a href="#" class="text-default">{{ $country->name}}</a>
                                @endif
                            @else
                                <a href="#" class="text-default">{{ $country->name}}</a>
                            @endif
                        </h5>
                        {{--<h4 class="text-semibold mb-5">--}}
                        {{--<a href="#" class="text-default">{{ $country->nationality}}</a>--}}
                        {{--</h4>--}}
                        <h5 class="text-semibold mb-5">
                            @if(auth()->user())
                                <?php $role_permission = new \App\Http\Controllers\RoleController(); ?>
                                @if(is_bool($role_permission->checkRolePermission("show_followers")))
                                    <a href="#" class="text-default"> {{ 'Followers: '. $count }}</a>
                                @endif
                            @endif
                        </h5>
                        @if(auth()->user())
                            @if($country->user->id == auth()->user()->id)
                                <h3 class="text-semibold mb-5">
                                    <a href="#" class="text-default">{!! $details->about_us !!} </a>
                                </h3>
                            @else
                                <h3 class="text-semibold mb-5">
                                    <a href="#" class="text-default">{{ $country->description}}</a>
                                </h3>
                            @endif
                        @else
                            <h3 class="text-semibold mb-5">
                                <a href="#" class="text-default">{{ $country->description}}</a>
                            </h3>
                        @endif
                        {{--<ul class="list-inline list-inline-separate text-muted content-group">--}}
                        {{--<li> {{ date('F d\t\h, Y',strtotime($country->created_at)) }}</li>--}}
                        {{--</ul>--}}
                        <ul class="list-inline">
                            @if(isset($follow) && $follow == 1)
                                <li><a href="{{ url('country/follow/'.$country->id) }}" class="followlink"><b
                                                class="btn btn-default follow"> Followed </b></a></li>
                            @else
                                <li><a href="{{ url('country/follow/'.$country->id) }}" class="followlink"><b
                                                class="btn btn-default follow"> Follow </b></a></li>
                            @endif
                            <li class="list-inline-item">Share:</li>
                            <li class="list-inline-item"><a
                                        href="https://www.facebook.com/sharer/sharer.php?u= {{URL::current()}}"
                                        class="social-button " id=""><span class="fa fa-facebook-official"></span></a>
                            </li>
                            <li class="list-inline-item"><a
                                        href="https://twitter.com/intent/tweet?text=my share text&amp;url={{URL::current()}}"
                                        class="social-button " id=""><span class="fa fa-twitter"></span></a></li>
                            <li class="list-inline-item"><a href="https://plus.google.com/share?url={{URL::current()}}"
                                                            class="social-button " id=""><span
                                            class="fa fa-google-plus"></span></a>
                            </li>
                            <li class="list-inline-item"><a
                                        href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}&amp;title=my share text&amp;summary=dit is de linkedin summary"
                                        class="social-button " id=""><span class="fa fa-linkedin"></span></a></li>
                        </ul>
                    </div>

                    <div class="panel-footer panel-footer-condensed">
                        <div class="heading-elements not-collapsible">
                            <ul class="list-inline list-inline-separate heading-text text-muted">
                                {{--<li><a href="#" class="text-muted"><i--}}
                                {{--class="icon-heart6 text-size-base text-pink position-left"></i>--}}
                                {{--29</a></li>--}}
                            </ul>
                            @if(!empty(auth()->user()))
                                @if(auth()->user()->type == 0)
                                    <a href="{{ url('panel/countries/country/'.$country->id) }}"
                                       class="heading-text pull-left"> <i class="icon-arrow-left13 position-right"></i>
                                        Edit
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('styles')
    <link rel="stylesheet" href="{{ asset('css/view.country.css') }}">
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('.followlink').on('click', function (e) {
                $('.follow').attr(function (e) {
                    $this.replace($this.val(e), 'Followed');
                });
            });
        });

    </script>
@stop