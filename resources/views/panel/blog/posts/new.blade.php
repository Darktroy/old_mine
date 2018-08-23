@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div id="new_slide_form">
            {!! Form::open(['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left','files'=>true])  !!}

            <div class="form-group">
                {!! Form::label('title','Title :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('title',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <input type="hidden" name="tags" value="{{ implode(',',$tags) }}">
            <div class="form-group">
                {!! Form::label('images[]','image :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <button class="btn btn-primary add_image"> Add Image</button>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::file('images[]',['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group mini_description">
                {!! Form::label('mini_description','Mini Description :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('mini_description',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description','Description :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('description',null,['class'=>'form-control col-md-7 col-xs-12 add_tiny']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('category_id',$categories,null,['class'=>'form-control col-md-7 col-xs-12','id'=>'category','data-url'=>url('panel/blog/category/posts')]) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Input Tags</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('tags',null,['id'=>'magicsuggest','class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>

            </div>

            <div class="form-group">
                {!! Form::label('meta_title','Meta Title :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('meta_title',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('meta_description','Meta Description :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('meta_description',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="checkbox">
                <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                <label>
                    {!! Form::checkbox('active',1,null) !!} Active
                </label>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ asset('panel/js/magicsuggest-min.js') }}"></script>
    <script>
        $(function () {
            var tags = $('input[name="tags"]').val().split(',');
            $('#magicsuggest').magicSuggest({
                data: tags
            });
        });
    </script>
@stop