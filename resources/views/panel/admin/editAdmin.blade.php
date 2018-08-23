@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        {!! Form::model($user,['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left',
        'files'=>true ])  !!}

        <div class="form-group">
            {!! Form::label('email','Email:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::email('email',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('name','Name:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('name',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('profile','image:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::file('image',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password:</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="password" class="form-control col-md-7 col-xs-12" value="">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password Confirmation:</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" name="password_confirmation" class="form-control col-md-7 col-xs-12"
                       value="">
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop