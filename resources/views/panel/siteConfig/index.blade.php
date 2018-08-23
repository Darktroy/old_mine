@extends('layouts.panel.blank_page')
@section('plank_content')
    {!! Form::open(['files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('facebook','Facebook:') !!}
        {!! Form::url('facebook',\App\Models\SiteConfig::getValueByKey('facebook'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('twitter','twitter:') !!}
        {!! Form::url('twitter',\App\Models\SiteConfig::getValueByKey('twitter'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('googleplus','googleplus:') !!}
        {!! Form::url('googleplus',\App\Models\SiteConfig::getValueByKey('googleplus'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('youtube','youtube:') !!}
        {!! Form::url('youtube',\App\Models\SiteConfig::getValueByKey('youtube'),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('inst','Instgram:') !!}
        {!! Form::url('inst',\App\Models\SiteConfig::getValueByKey('inst'),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('linked','LinkedIn:') !!}
        {!! Form::url('linked',\App\Models\SiteConfig::getValueByKey('linked'),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('desc','About us:') !!}
        {!! Form::textarea('desc',\App\Models\SiteConfig::getValueByKey('desc'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('address','Address:') !!}
        {!! Form::text('address',\App\Models\SiteConfig::getValueByKey('address'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('phone','Phone:') !!}
        {!! Form::text('phone',\App\Models\SiteConfig::getValueByKey('phone'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email','Email:') !!}
        {!! Form::email('email',\App\Models\SiteConfig::getValueByKey('email'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('skype','Skype:') !!}
        {!! Form::text('skype',\App\Models\SiteConfig::getValueByKey('skype'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('whatsApp','whatsApp:') !!}
        {!! Form::number('whatsApp',\App\Models\SiteConfig::getValueByKey('whatsApp'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('viber','Viber:') !!}
        {!! Form::number('viber',\App\Models\SiteConfig::getValueByKey('viber'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('web','Web Site:') !!}
        {!! Form::url('web',\App\Models\SiteConfig::getValueByKey('web'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('intro_video','Link for intro video:') !!}
        {!! Form::url('intro_video',\App\Models\SiteConfig::getValueByKey('intro_video'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('logo','Logo') !!}
        {!! Form::file('logo',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('footer_logo','Footer Logo') !!}
        {!! Form::file('footer_logo',null,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
@stop