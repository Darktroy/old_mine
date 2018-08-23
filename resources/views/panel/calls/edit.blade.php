@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div id="new_slide_form">
            {!! Form::model($call,['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left','files'=>true])  !!}

            <div class="form-group ">
                {!! Form::label('for','Call For:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}

                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('for',['v'=>'Volunteers','i'=>'Intern','e'=>'Employee'],null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('title','Call Title:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('title',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('person','Contact Person :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('person',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email','Email:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::email('email',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('task_details','Task With All Details:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('task_details',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group control-label col-md-3 col-sm-3 col-xs-12">
                <label>
                    {!! Form::checkbox('special_skills',1,null,['class'=>'special_skills']) !!} required Special Skills
                </label>

            </div>

            <div class="form-group skills_details">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('skills_details',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="form-group">
                {!! Form::label('deadline','Call Dead Line :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12 input-group date">
                    <input type="text" name="deadline" value="{{ date('Y-m-d',strtotime($call->deadline)) }}" class="deadline form-control">
                    <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('selection','Date Of Selection :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12 input-group date">
                    <input type="text" name="selection" value="{{ date('Y-m-d',strtotime($call->selection)) }}" class="selection form-control">
                    <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('number','Required Number :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::number('number',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('working_hours','Voluntery hours per person :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::number('working_hours',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('gender','Gender :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('gender',['m'=>'male','f'=>'female','b'=>'both'],null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('from','From :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12 input-group date">
                    <input type="text" name="from" value="{{ date('Y-m-d',strtotime($call->from)) }}" class="from form-control">
                    <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('to','To :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12 input-group date">
                    <input type="text" name="to" value="{{ date('Y-m-d',strtotime($call->to)) }}" class="to form-control">
                    <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('workplace','Workplace :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('workplace',['o'=>'Online','f'=>'Offline','b'=>'both'],null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('call_country','Country :',['class'=>'control-label call_country col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('call_country[]',[null=>'Select Country']+$countries,$countries_ids,['class'=>'form-control call_country','id'=>'call_country','multiple'=>true,'data-url'=>url('panel/calls/new/get-country-cities'),'token'=>csrf_token()]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('call_city','Cities:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('call_city[]',[null=>'Select City']+$cities,$cities_ids,['class'=>'form-control call_city','multiple'=>true]) !!}
                </div>
            </div>

            <div class="form-group ">
                {!! Form::label('benefits','Benefits :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('benefits',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('more','More Information :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('more',null,['class'=>'form-control']) !!}
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
    </div>
@stop
@section('scripts')
    <script>
        $('#call_country').on('change',function () {
            var countries_id =$(this).val();
            var url = $(this).data('url');
            var token = $(this).data('token');
            $.ajax({
                url:url,
                data:{'countries_id':countries_id,'_token':token},
                type:'GET',
                success:function (response) {
//                    console.log(response);
                    $('.call_city').empty();
                    $.each(response.cities,function (k,v) {
                        $('.call_city').append(`<option value="${k}"> ${v} </option>`)
//                        console.log(k,v);
                    })
                }
            })
        })
    </script>
@stop