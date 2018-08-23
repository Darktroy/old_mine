@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <ul class="pagination pagination-split">
                                <li><a href="{{ url('panel/countries/') }}">All</a></li>
                                @foreach(range('A', 'Z') as $chr)
                                    <li><a href="{{ url('panel/countries/'.$chr) }}">{{ $chr }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="clearfix"></div>


                        @foreach($countries as $country)
                            <div class="col-sm-6 col-xs-3 col-lg-push-0">
                                <div class="w3-col m1 w3-center" style="align-items: center">
                                    <div class="right col-xs-3 col-md-12  text-center"
                                         style="border: 3px solid #858585; width: 500px; height: 50px">
                                        <a href="{{ url('countries/country/'.$country->id) }}" style="color: #413209">
                                            <b style="align-items: center; font-size: x-large">{{ $country->name }}</b></a>
                                    </div>
                                    <br><br><br>
                                </div>
                            </div>
                        @endforeach


                        {{--@foreach($countries as $country)--}}
                        {{--<div class="col-md-4 col-sm-4 col-xs-12 profile_details">--}}
                        {{--<div class="well profile_view">--}}
                        {{--<div class="col-sm-12">--}}
                        {{--<h4 class="brief"><i>{{ $country->name }}</i></h4>--}}
                        {{--<div class="left col-xs-7">--}}
                        {{--<h2>{{ $country->nationality }}</h2>--}}
                        {{--<p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>--}}
                        {{--<ul class="list-unstyled">--}}
                        {{--<li><i class="fa fa-building"></i> Address: </li>--}}
                        {{--<li><i class="fa fa-phone"></i> Phone #: </li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="right col-xs-5 text-center">--}}
                        {{--<img src="{{ asset('media/flags/'.$country->flag) }}" alt="" class="img-circle img-responsive">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12 bottom text-center">--}}
                        {{--<div class="col-xs-12 col-sm-6 emphasis">--}}
                        {{--<!--<button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">--}}
                        {{--</i> <i class="fa fa-comments-o"></i> </button>-->--}}
                        {{--<a href="{{ url('panel/countries/country/'.$country->id) }}" class="btn btn-primary btn-xs">--}}
                        {{--<i class="fa fa-user"> </i> View Profile--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--@endforeach--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $countries->links() }}

@stop