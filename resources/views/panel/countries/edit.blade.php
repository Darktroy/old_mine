@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div id="new_slide_form">
            {!! Form::model($country,['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left'])  !!}

            <div class="form-group">
                {!! Form::label('name','Name:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('name',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('nationality','Nationality:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('nationality',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('phone_code','Country Code:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('phone_code',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('descripiton','Description:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('description',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            {{--<div class="form-group">--}}
            {{--{!! Form::label('country_id','Country:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}--}}
            {{--<div class="col-md-6 col-sm-6 col-xs-12">--}}
            {{--{!! Form::select('country_id',$countries,null,['class'=>'form-control col-md-7 col-xs-12']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}


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