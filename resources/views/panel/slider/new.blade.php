@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div id="new_slide_form">
            {!! Form::open(['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left',
            'files'=>true ])  !!}

            <div class="form-group">
                {!! Form::label('profile','image:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::file('image',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('title','Title:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('title',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('caption','Caption:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('caption',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('red_button_title','Red Button Title',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="red_button_title" class="form-control col-md-7 col-xs-12"
                           v-model="red_button_title"/>
                </div>
            </div>

            <div class="form-group" v-if="red_button_title">
                {!! Form::label('red_button_url','Red Button Url',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::url('red_button_url',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('transparent_button_title','Transparent Button Title',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="transparent_button_title" v-model="transparent_button_title"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group" v-if="transparent_button_title">
                {!! Form::label('transparent_button_url','Transparent Button Url',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::url('transparent_button_url',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
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

