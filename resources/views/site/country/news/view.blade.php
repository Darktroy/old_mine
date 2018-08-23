@extends('layouts.site.news_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('page_content')

    @if(isset($position) && $position ==2 )
        <?php $filterBy = $country_id . '/' . $position; ?>
    @else
        <?php $filterBy = auth()->user()->id . '/' . $position; ?>
    @endif
    <!-- Details -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="media stack-media-on-mobile text-left content-group-lg">
                <div class="media-body">
                    <h5 class="media-heading text-semibold"> {{ $news->title }} </h5>
                    <ul class="list-inline list-inline-separate text-muted no-margin">
                        <li>  {{ $news->country->name }} </li>
                        <li>{{ Euromed::time_elapsed_string($news->created_at) }}</li>
                    </ul>
                </div>

                <div class="media-right media-middle text-nowrap">
                    <a href="{{url('country/news/'.$filterBy)}}" class="btn bg-blue"><i
                                class="position-left"></i> All news</a>
                </div>
            </div>

            <div class="content-group-lg">
                <ul class="list">
                    <li>
                        <div class="thumb content-group">
                            {{--{{ dd($post->poster) }}--}}
                            <img src="{{ ( isset($news->poster) && !empty($news->poster)) ? asset('media/news/'.$news->poster) : '' }}"
                                 alt="" class="img-responsive" style="height: 300px; width: 400px">
                        </div>
                    </li>
                    <li>
                        <strong class="display-block">Mini description :</strong>
                        {!! $news->mini_description  !!}
                    </li>
                    <li>
                        <strong class="display-block">Description :</strong>
                        {!! $news->description !!}

                    </li>
                </ul>
            </div>


        </div>
    </div>
@stop