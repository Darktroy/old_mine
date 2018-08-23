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
            <h6 class="panel-title">New Topic</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>

        <div class="panel-body posts_form">

            {!! Form::open(['url'=>"country/topics/new",'method' => 'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('title','Title: ') !!}
                        {!! Form::text('title',null,['class'=>'']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('category_id','Category: ') !!}
                        {!! Form::select('category_id',$categories,null,['class'=>'form-control','id'=>'category']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label class="display-block">Poster</label>
                        <input type="file" name="images[]" class="file-styled">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                    <div class="col-md-6">
                        <label for="tags"> Tags </label>

                        {!! Form::select('tags[]',$posts_tags,null,['class'=>'form-control','id'=>'tags','multiple'=>'multiple']) !!}

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('meta_title','Meta Title :') !!}
                        {!! Form::text('meta_title',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::label('meta_description','Meta Description :') !!}
                        {!! Form::textarea('meta_description',null,['class'=>'form-control','rows'=>5,'max'=>150]) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="mini_description"> Main Description </label>
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
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>

    <script src="{{ asset('panel/tinymce/tinymce.min.js') }}"></script>
    <script>
        $('select').select2();
        $('input.timepicker').timepicker({});

        tinymce.init({
            selector: '.add_tiny',
            height: 250,
            width: 100 + '%',
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
@stop


