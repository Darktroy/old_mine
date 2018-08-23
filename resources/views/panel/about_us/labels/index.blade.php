@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">

        @foreach($labels as $label)
            <div class="col-md-55">
                <div class="thumbnail">
                    <div class="image view view-first">
                        <img style="width: 100%; display: block;" src="{{ asset('media/labels/logo/'.$label->logo) }}" alt="image"/>
                        <div class="mask">
                            <p>{{ $label->title }}</p>
                            <div class="tools tools-bottom">
                                <a href="{{ asset('media/labels/logo/'.$label->logo) }}" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="{{ url("panel/about_us/labels/{$label->id}/edit") }}"><i class="fa
                                fa-pencil"></i></a>
                                <form action="{{ url('panel/about_us/labels/'.$label->id.'/delete') }}" method="POST" onsubmit="confirm('are you sure you want to delete ?')" style="display:inline;">
                                {{ csrf_field() }}
                                    <button class="delete_button"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="caption">
                        <p>{{ $label->title }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop