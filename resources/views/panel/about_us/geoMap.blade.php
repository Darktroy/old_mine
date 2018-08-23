@extends('layouts.panel.blank_page')
@section('plank_content')
    {!! Form::open(['files'=>true,'url'=>url('panel/admin/site-config')]) !!}
    <div class="form-group">
        {!! Form::label('geo_description','GeoLocation Description :') !!}
        {!! Form::textarea('geo_description',\App\Models\SiteConfig::getValueByKey('geo_description'),['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::label('geo_image','Map Image') !!}
        {!! Form::file('geo_image',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
@stop