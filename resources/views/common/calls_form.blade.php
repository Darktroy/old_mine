{{--
    // this file include call form body only
    // without form start and tags
--}}
<style>
    .input-group[class*=col-]{
        padding-right:15px;
        padding-left:15px;
    }
</style>


    <div class="form-group {{ $errors->has('for') ? ' has-error' : '' }} ">
        {!! Form::label('for','Call For:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}

        @if ($errors->has('for'))
            <span class="help-block">
                <strong>{{ $errors->first('for') }}</strong>
            </span>
        @endif
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="for" id="for" class="form-control">
                <option value="v"> Volunteers</option>
                <option value="i"> Intern</option>
                <option value="e"> Employee</option>
            </select>
        </div>
    </div>

    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title','Call Title:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
            {!! Form::text('title',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('person') ? ' has-error' : '' }}">
        {!! Form::label('person','Contact Person :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('person'))
                <span class="help-block">
                    <strong>{{ $errors->first('person') }}</strong>
                </span>
            @endif
            {!! Form::text('person',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
        {!! Form::label('email','Email:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            {!! Form::email('email',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('task_details') ? ' has-error' : '' }}">
        {!! Form::label('task_details','Task With All Details:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('task_details'))
                <span class="help-block">
                    <strong>{{ $errors->first('task_details') }}</strong>
                </span>
            @endif
            {!! Form::textarea('task_details',null,['class'=>'form-control add_tiny']) !!}
        </div>
    </div>

    <div class="form-group control-label col-md-3 col-sm-3 col-xs-12">
        <label>
            {!! Form::checkbox('special_skills',1,null,['class'=>'special_skills']) !!} required Special Skills
        </label>

    </div>

    <div class="form-group skills_details">
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::textarea('skills_details',null,['class'=>'form-control add_tiny']) !!}
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="form-group {{ $errors->has('deadline') ? ' has-error' : '' }}">
        {!! Form::label('deadline','Call Dead Line : (leave empty of its opened)',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('deadline'))
                <span class="help-block">
                    <strong>{{ $errors->first('deadline') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 input-group date col-md-offet-3 col-sm-offset-3">
            {!! Form::text('deadline',null,['class'=>'form-control datepicker col-md-7 col-xs-12 ']) !!}
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
        </div>

    </div>

    <div class="form-group {{ $errors->has('selection') ? ' has-error' : '' }}">
        {!! Form::label('selection','Date Of Selection :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('selection'))
                <span class="help-block">
                    <strong>{{ $errors->first('selection') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 input-group date col-md-offet-3 col-sm-offset-3">
            {{--  <input type="text" name="selection" class="selection datepicker form-control">  --}}
            {!! Form::text('selection',null,['class'=>'form-control datepicker col-md-7 col-xs-12 ']) !!}
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
        </div>
    </div>

    <div class="form-group {{ $errors->has('number') ? ' has-error' : '' }}">
        {!! Form::label('number','Required Number :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('number'))
                <span class="help-block">
                    <strong>{{ $errors->first('number') }}</strong>
                </span>
            @endif
            {!! Form::number('number',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('working_hours') ? ' has-error' : '' }}">
        {!! Form::label('working_hours','Voluntery hours per person :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('working_hours'))
                <span class="help-block">
                    <strong>{{ $errors->first('working_hours') }}</strong>
                </span>
            @endif
            {!! Form::number('working_hours',null,['class'=>'form-control col-md-7 col-xs-12 ']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
        {!! Form::label('gender','Gender :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('gender'))
                <span class="help-block">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
            {!! Form::select('gender',['m'=>'male','f'=>'female','b'=>'both'],null,['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('from') ? ' has-error' : '' }}">
        {!! Form::label('from','From :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('from'))
                <span class="help-block">
                <strong>{{ $errors->first('from') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 input-group date col-md-offset-3 col-sm-offset-3">
            {{--  <input type="text" name="from" class="from form-control">  --}}
            {!! Form::text('from',null,['class'=>'form-control from col-md-7 col-xs-12 ']) !!}
            <span class="input-group-addon">
                <i class="glyphicon glyphicon-th"></i>
            </span>
        </div>
    </div>

    <div class="form-group {{ $errors->has('to') ? ' has-error' : '' }}">
        {!! Form::label('to','To :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('to'))
                <span class="help-block">
                <strong>{{ $errors->first('to') }}</strong>
            </span>
            @endif
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 input-group date col-md-offset-3 col-sm-offset-3">
            {{--  <input type="text" name="to" class="to form-control">  --}}
            {!! Form::text('to',null,['class'=>'form-control to col-md-7 col-xs-12 ']) !!}
            <span class="input-group-addon">
        <i class="glyphicon glyphicon-th"></i>
    </span>
        </div>
    </div>

    <div class="form-group {{ $errors->has('workplace') ? ' has-error' : '' }}">
        {!! Form::label('workplace','Workplace :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('workplace'))
                <span class="help-block">
                <strong>{{ $errors->first('workplace') }}</strong>
            </span>
            @endif
            {!! Form::select('workplace',['o'=>'Online','f'=>'Offline','b'=>'both'],null,['class'=>'form-control']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('call_country') ? ' has-error' : '' }}">
        {!! Form::label('call_country','Country :',['class'=>'control-label call_country col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('call_country'))
                <span class="help-block">
                    <strong>{{ $errors->first('call_country') }}</strong>
                </span>
            @endif
            @php
                $user_type = '';
                if(\auth()->user()->type == 1 || \auth()->user()->type == 4){
                    $user_type = 'country';
                }elseif(\auth()->user()->type == 2){
                    $user_type = 'company';
                }
                
            @endphp
            {!! Form::select('call_country[]',$countries,(isset($call_countries) && !empty($call_countries) ? $call_countries : null),['class'=>'form-control call_country','id'=>'call_country','multiple'=>true,'data-url'=>url($user_type.'/calls/new/get-country-cities'),'token'=>csrf_token()]) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('call_city') ? ' has-error' : '' }}">
        {!! Form::label('call_city','Cities:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('call_city'))
                <span class="help-block">
                    <strong>{{ $errors->first('call_city') }}</strong>
                </span>
            @endif
            {!! Form::select('call_city[]',$cities,(isset($call_cities) && !empty($call_cities) ? $call_cities : null),['class'=>'form-control call_city','multiple'=>true]) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('benefits') ? ' has-error' : '' }} ">
        {!! Form::label('benefits','Benefits :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('benefits'))
                <span class="help-block">
                    <strong>{{ $errors->first('benefits') }}</strong>
                </span>
            @endif
            {!! Form::textarea('benefits',null,['class'=>'form-control add_tiny']) !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('more') ? ' has-error' : '' }} ">
        {!! Form::label('more','More Information :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            @if ($errors->has('more'))
                <span class="help-block">
                    <strong>{{ $errors->first('more') }}</strong>
                </span>
            @endif
            {!! Form::textarea('more',null,['class'=>'form-control add_tiny']) !!}
        </div>
    </div>

    <div class="checkbox" style="display: inline;">
        {!! Form::checkbox('status','1',null,['id'=>'active']) !!}
        <label for="active" style="padding-left: 5px;">Active</label>
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary" :disabled="disabled">Save <i
                    class="icon-arrow-right14 position-right"></i>
        </button>
    </div>



@section('scripts')
    <script>
        $(document).ready(function(){
            if($('input.special_skills').is(':checked')){
                $('.skills_details').show();
            }
            
            $('#call_country').on('change', function () {
                var countries_id = $(this).val();
                var url = $(this).data('url');
                var token = $(this).data('token');
                $.ajax({
                    url: url,
                    data: {'countries_id': countries_id, '_token': token},
                    type: 'GET',
                    success: function (response) {
                        // console.log(response);
                        $('.call_city').empty();
                        $.each(response.cities, function (k, v) {
                            $('.call_city').append(`<option value="${k}"> ${v} </option>`)
                            //  console.log(k,v);
                        })
                    }
            })
        })

        });
    </script>
@endsection
