@extends('layouts.site.country')
@section('country_account')

    <div class="site_application" style="  background-color: #efefef;  padding: 60px; margin: 60px;">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

        {!! Form::open(['url'=>'country/contact_us/'.$country_id,'method' => 'POST','enctype' => "multipart/form-data"]) !!}

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="first_name"> First Name * </label>
                {!! Form::text("name",null,['class'=>'form-control','id'=>'name','name'=>'name']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="last_name"> Last Name * </label>
                {!! Form::text("last_name",null,['class'=>'form-control','id'=>'last_name','name'=>"last_name"]) !!}
            </div>

            <div class="col-xs-12">
                <label for="email"> Email * </label>
                {!! Form::email('email',null,['class'=>'form-control','id'=>'email']) !!}
            </div>

            <div class="col-xs-12">
                <label for="last_name"> Subject * </label>
                {!! Form::text("subject",null,['class'=>'form-control','id'=>'subject','name'=>"subject"]) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <label for="Description"> Message </label>
                {!! Form::textarea('message',$user->country->description,['class'=>'form-control add_tiny']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Send',['class' => 'btn btn-info active']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop