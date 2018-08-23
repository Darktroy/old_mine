@extends('layouts.site.inner_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop


@section('page_content')
    <div class="site_application" style="background-color: #efefef;  padding: 60px; margin: 60px;">
        {!! Form::open(['url'=>'invite/invite-save','method' => 'POST','enctype'=>'multipart/form-data']) !!}

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="org_name"> Organization Name </label>
                {!! Form::text('org_name',$organization->Organizations->org_name,['class'=>'form-control','id'=>'org_name','disabled']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="country"> Country * </label>
                {!! Form::select('country_id',[''=>'Select Country'] + $countries,null,['class'=>'form-control countries_list','data-url'=>url('countries/getcities/')]) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="user_type"> User Category * </label>
                <select id="inputState" class="form-control" name="user_type">
                    <option value=0>Change Maker</option>
                    <option value=1>Company</option>
                    <option value=2>Partner</option>
                    <option value=3>National Organization</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="email"> Email/Username * </label>
                {!! Form::email('email',null,['class'=>'form-control','id'=>'email']) !!}
            </div>
            <div class="col-xs-12 col-md-6" style="display: none;">
                <label for="subj_name"> Subject Name * </label>
                {!! Form::text('subj_name',$organization->Organizations->org_name." invitation",['class'=>'form-control','id'=>'subj_name']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::label('Content *') !!}
                {!! Form::textarea('content',$organization->Organizations->org_name." invite you to join our community in Euromed",['class'=>'form-control add_tiny' , 'id'=> 'content']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Send invitation',['class' => 'btn btn-info active']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@stop