@extends('layouts.site.inner_pages_layout')
@section('page_content')
    <!--Tabs Section-->
    <section class="tabs-section">
        <div class="row">

            <div class="tabs-box clearfix">

                <!--Buttons Side-->
                <div class="col-md-4 col-sm-6 col-xs-12 buttons-side">

                    <div class="sec-title">
                        <h2 class="skew-lines">Our <strong>services</strong></h2>
                    </div>
                    <!--Tab Buttons-->
                    <ul class="tab-buttons">
                        @foreach($labels as $k => $label)
                            @if($k == 0)
                                <?php $active_item = ' active-btn' ?>
                            @else
                                <?php $active_item = null ?>
                            @endif
                            <li class="wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1000ms">
                                <a href="#tab-{{$k+1}}" class="tab-btn {{ $active_item }} clearfix">
                                    <div class="icon">
                                        <span class="flaticon-blank36"></span>
                                    </div>
                                    <h4>{{ $label->title }}</h4>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!--Content Side-->
                <div class="col-md-8 col-sm-6 col-xs-12 tabs-content clearfix">
                @foreach($labels as $k => $label)
                    @if($k == 0)
                        <?php $active_description = 'active-tab' ?>
                    @else
                        <?php $active_description = null ?>
                    @endif
                    <!--Tab / Active tab-->
                        <!--Tab / Active tab-->
                        <div class="tab {{$active_description}}" id="tab-{{$k+1}}">
                            <div class="sec-title">
                                <h2>  {{ $label->title }} </h2>
                            </div>
                            <div class="text">
                                <p> {{ $label->description }} </p>
                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </section>
@stop