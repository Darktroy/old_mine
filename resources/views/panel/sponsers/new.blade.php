@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div id="new_sponser_form">
            {!! Form::open(['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left',
            'files'=>true ])  !!}

            <div class="form-group">
                {!! Form::label('image','image:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::file('image',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('name','Name:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('name',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('url','Url:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::url('url',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
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

