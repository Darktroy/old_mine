@extends('layouts.site.country')
@section('country_account')
    <!-- Profile info -->

    @if($errors->any())
        @include('errors.list')
    @endif

    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span>
            </button>
            {{ session('message') }}
        </div>
    @endif

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">New News</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>

        <div class="panel-body posts_form">

            {!! Form::open(['url'=>"country/news/new",'method' => 'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('title','Title: ') !!}
                        {!! Form::text('title',null,['class'=>'']) !!}
                    </div>
                    <div class="col-md-6">
                        <label class="display-block">Poster</label>
                        <input type="file" name="image" class="file-styled">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="mini_description"> Min Description </label>
                        {!! Form::textarea('mini_description',null,['class'=>'form-control','rows'=>5,'max'=>150]) !!}
                    </div>
                    <div class="col-md-12">
                        <label for="Description"> Description </label>
                        {!! Form::textarea('description',null,['class'=>'form-control add_tiny']) !!}
                    </div>
                </div>
            </div>

            <div class="checkbox" style="display: inline;">
                {!! Form::checkbox('active','1',null,['id'=>'active']) !!}
                <label for="active" style="padding-left: 5px;">Active</label>
            </div>

            <div class="checkbox" style="display: inline;">
                {!! Form::checkbox('slider','1',null,['id'=>'slider']) !!}
                <label for="slider" style="padding-left: 5px;">Add To Slider</label>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i>
                </button>
            </div>
            {!! Form::close() !!}


        </div>
    </div>
    <!-- /profile info -->

@stop

@section('scripts')
    {{--  <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('panel/tinymce/tinymce.min.js') }}"></script>  --}}

@stop


