@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">

        @foreach($slides as $slide)
            <div class="col-md-55">
                <div class="thumbnail">
                    <div class="image view view-first">
                        <img style="width: 100%; display: block;" src="{{ asset($slide->image) }}" alt="image"/>
                        <div class="mask">
                            <p>{{ $slide->title }}</p>
                            <div class="tools tools-bottom">
                                <a href="{{ asset($slide->image) }}"><i class="fa fa-link"></i></a>
                                <a href="{{ url("panel/home/slider/{$slide->id}/edit") }}"><i class="fa
                                fa-pencil"></i></a>
                                <a href="#"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="caption">
                        <p>{{ $slide->title }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $slides->links() }}
    </div>
@stop