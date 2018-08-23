@extends('layouts.panel.blank_page')
@section('plank_content')
        <div class="row">
        <div id="new_slide_form">
            {!! Form::open(['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left'])  !!}

            <div class="form-group">
                {!! Form::label('question','Question:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('question',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('answer','Answer:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('answer',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('category','Category:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('category',[
                        'r_m'=>'Register Change Maker',
                        'r_c'=>'Register Company',
                        'r_p'=>'Register Partner',
                        "r_o"=>"Register Organization",
                        'l'=>'label',
                        "f"=>"Fees",
                        'd'=>'Donation',
                        'g'=>'General',
                        null=>'Select Category'
                        ],null,['class'=>'form-control col-md-3 col-sm-3 col-xs-12']) !!}
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