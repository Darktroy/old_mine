@extends('layouts.site.inner_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('page_content')


    <div class="site_login">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

        <div class="sec-title">
            <h2 class="text-center"> Registee As Change Maker </h2>
        </div>

        @include('errors.list')
        @if(session('returned_inputs'))
            <?php $related_inputs = session('returned_inputs')  ?>
        @endif
        {!! Form::open(['files'=>true]) !!}

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="last_name"> Last Name * </label>
                {!! Form::text('last_name',null,['class'=>'form-control','id'=>'last_name','required' => 'required']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="first_name"> First Name * </label>
                {!! Form::text('first_name',null,['class'=>'form-control','id'=>'first_name','required' => 'required']) !!}
                
            </div>
        </div>

        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="email"> Email * </label>
                {!! Form::email('email',null,['class'=>'form-control','id'=>'email','required' => 'required']) !!}
               
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="p_link"> Private Link * </label>
                {!! Form::text('p_link',null,['class'=>'form-control','id'=>'p_link','required' => 'required']) !!}
                
            </div>

        </div>


        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="gender"> Gender * </label>
                {!! Form::select('gender',['m'=>'Male','f'=>'Female'],null,['class'=>'form-control',
                'required' => 'required']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="birth_date"> Birth Date * </label>
                {!! Form::date('birth_date',null,['class'=>'form-control','id'=>'birth_date',
                'required' => 'required']) !!}
                
            </div>

        </div>

        <div class="form-group">

            <div class="col-xs-12 col-md-4">
                <label for="nationality"> Nationality * </label>
                {!! Form::text('nationality',null,['class'=>'form-control','id'=>'nationality','required' => 'required']) !!}
                
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="gender"> Country * </label>
                {!! Form::select('country_id',[''=>'Select Country'] + $countries,null,['class'=>'form-control countries_list','data-url'=>url('countries/getcities/'),'required' => 'required']) !!}
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="city"> City * </label>
                {!! Form::select('city_id',[''=>'select City'],null,['class'=>'form-control cities_list','required' => 'required']) !!}
            </div>

        </div>


        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="address"> Address * </label>
                {!! Form::text('address',null,['class'=>'form-control','id'=>'address','required' => 'required']) !!}
                
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="phone"> Phone * </label>
                {!! Form::text('phone',null,['class'=>'form-control','id'=>'phone','required' => 'required']) !!}
                {{-- <input type="text" name="phone" class="form-control" id="phone" required> --}}
            </div>

        </div>

        <h5> Education: </h5>
        <br>
        @if(!isset($related_inputs) && empty($related_inputs) && empty($related_inputs['edu']))
            <div class="form-group">

                <div class="col-xs-12 col-md-6">
                    <label for="degree"> Degree * </label>
                    <input type="text" name="edu[1][degree]" 
                           class="form-control" id="degree" required>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="field"> Field </label>
                    <input type="text" name="edu[1][field]" 
                           class="form-control" id="field" required>
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="u_i_name"> University/ institute name </label>
                    <input type="text" name="edu[1][u_i_name]" class="form-control" 
                           id="u_i_name" required>
                </div>
                <div class="col-xs-12 col-md-6">
                    {!! Form::label('obtained_year','Obtained year :') !!}
                    <div class=" input-group date">
                        <input type="text" name="edu[1][obtained_year]" 
                               class="datepicker form-control" required>
                        <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                    </div>
                </div>

            </div>
        @endif

        @if(isset($related_inputs) && !empty($related_inputs) && !empty($related_inputs['edu']) )
            @foreach($related_inputs['edu'] as $k => $input)
                <hr>
                <div class="form-group">

                    <div class="col-xs-12 col-md-6">
                        <label for="degree"> Degree * </label>
                        <input type="text" name="edu[{{$k}}][degree]" value="{{ $input['degree'] }}"
                               class="form-control" id="degree" required>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="field"> Field </label>
                        <input type="text" name="edu[{{$k}}][field]" value="{{ $input['field'] }}" class="form-control"
                               id="field" required>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label for="u_i_name"> University/ institute name </label>
                        <input type="text" name="edu[{{$k}}][u_i_name]" value="{{ $input['u_i_name'] }}"
                               class="form-control" id="u_i_name" required>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        {!! Form::label('obtained_year','Obtained year :') !!}
                        <div class=" input-group date">
                            <input type="text" name="edu[{{$k}}][obtained_year]" value="{{ $input['obtained_year'] }}"
                                   class="datepicker form-control" required>
                            <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                        </div>
                    </div>

                </div>
            @endforeach
        @endif

        <div class="more_education">
            <a class="btn btn-primary one_education"> <i class="fa fa-plus"></i> More</a>
        </div>


        <br>

        <div class="form-group">
            <div class="col-xs-12">
                <label for="skills"> Skills </label>
                {!! Form::textarea('skills',null,['id'=>'skills','rows'=>'5','required' => 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <label for="interest">Sectors of Interest: * </label>
                {!! Form::select('sector_interestes[]',$sectors,null,['class'=>'form-controlfirstList',
                'multiple'=>'multiple','required' => 'required']) !!}
            </div>
        </div>


        <br>
        <br>


        <h5>Work Experiences:</h5>
        <br>
        @if(!isset($related_inputs) && empty($related_inputs) && empty($related_inputs['work_inputs']))
            <div class="form-group">
                <div class="col-xs-12 col-md-4">
                    <label for="position"> Position </label>
                    <input type="text" name="work[1][position]" class="form-control" id="position" required>
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="company"> Company Name </label>
                    <input type="text" name="work[1][company]" class="form-control" id="company" required>
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="work_country"> Work Country </label>
                    <input type="text" name="work[1][work_country]" class="form-control" id="work_country" required>
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="work_city"> Work City </label>
                    <input type="text" name="work[1][work_city]" class="form-control" id="work_country" required>
                </div>

                <div class="col-xs-12 col-md-4">
                    {!! Form::label('from','From :') !!}
                    <div class=" input-group date">
                        <input type="text" name="work[1][from]" class="datepicker form-control" required>
                        <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    {!! Form::label('to','To :') !!}
                    <div class=" input-group date">
                        <input type="text" name="work[1][to]" class="datepicker form-control" required>
                        <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                    </div>
                </div>


                <div class="col-xs-12">
                    <label for="job_description"> Description </label>
                    <textarea name="work[1][job_description]" id="job_description" rows="5" required></textarea>
                </div>
            </div>
        @endif

        @if(isset($related_inputs) && !empty($related_inputs) && !empty($related_inputs['work_inputs']) )
            @foreach($related_inputs['work_inputs'] as $k => $input)
                <hr>
                <div class="form-group">
                    <div class="col-xs-12 col-md-4">
                        <label for="position"> Position </label>
                        <input type="text" name="work[{{$k}}][position]" value="{{ $input['position'] }}"
                               class="form-control" id="position"required>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="company"> Company Name </label>
                        <input type="text" name="work[{{$k}}][company]" value="{{ $input['company'] }}"
                               class="form-control" id="company" required>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="work_country"> Work Country </label>
                        <input type="text" name="work[{{$k}}][work_country]" value="{{ $input['work_country'] }}"
                               class="form-control" id="work_country" required>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="work_city"> Work City </label>
                        <input type="text" name="work[{{$k}}][work_city]" value="{{ $input['work_city'] }}"
                               class="form-control" id="work_country" required>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        {!! Form::label('from','From :') !!}
                        <div class=" input-group date">
                            <input type="text" name="work[{{$k}}][from]" value="{{ $input['from'] }}"
                                   class="datepicker form-control" required>
                            <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4">
                        {!! Form::label('to','To :') !!}
                        <div class=" input-group date">
                            <input type="text" name="work[{{$k}}][to]" value="{{ $input['to'] }}"
                                   class="datepicker form-control" required>
                            <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-th"></i>
                                    </span>
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <label for="job_description"> Description </label>
                        <textarea name="work[{{$k}}][job_description]" id="job_description"
                                  rows="5" required> {{ $input['job_description'] }} </textarea>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="more_work">
            <a class="btn btn-primary one_work"> <i class="fa fa-plus"></i> More</a>
        </div>


        <br>
        <h5>Languages: *</h5>
        <br>
        @if(!isset($related_inputs) && empty($related_inputs) && empty($related_inputs['lang_inputs']))
            <div class="form-group">
                <div class="col-xs-12 col-md-4">
                    <label for="lang_name"> Lang Name </label>
                    <input type="text" name="lang[1][lang_name]" class="form-control" id="lang_name" required>
                </div>
                <div class="col-xs-12 col-md-8">
                    <label for="level"> Level </label>
                    <div class="form-input">
                        <label class="radio-inline">
                            <input type="radio" name="lang[1][level]" value="b" required> Beginner
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="lang[1][level]" value="i">Intermediate
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="lang[1][level]" value="a"> Advanced
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="lang[1][level]" value="f/n"> Fluent native
                        </label>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($related_inputs) && !empty($related_inputs) && !empty($related_inputs['lang_inputs']) )
            @foreach($related_inputs['lang_inputs'] as $k => $input)
                <div class="form-group">
                    <div class="col-xs-12 col-md-4">
                        <label for="lang_name"> Lang Name </label>
                        <input type="text" name="lang[{{$k}}][lang_name]" value="{{ $input['lang_name'] }}"
                               class="form-control" id="lang_name" required>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <label for="level"> Level </label>
                        <div class="form-input">
                            <label class="radio-inline">
                                <input type="radio" name="lang[{{$k}}][level]" class="check_{{$k}}" value="b" > Beginner
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="lang[{{$k}}][level]" class="check_{{$k}}" value="i">Intermediate
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="lang[{{$k}}][level]" class="check_{{$k}}" value="a"> Advanced
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="lang[{{$k}}][level]" class="check_{{$k}}" value="f/n"> Fluent
                                native
                            </label>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif


        <div class="more_langs">
            <a class="btn btn-primary one_lang"> <i class="fa fa-plus"></i> More</a>
        </div>

        <br>

        <div class="form-group">
            <div class="col-xs-12">
                <label for="Interestes"> Interestes </label>
                {!! Form::textarea('interestes',null,['rows'=>'5','required' => 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="facebook"> Facebook Url </label>
                {!! Form::text('facebook',null,['class'=>'form-control','id'=>'facebook','required' => 'required']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="linked_in"> Linkedin Url </label>
                {!! Form::text('linked_in',null,['class'=>'form-control','id'=>'linked_in','required' => 'required']) !!}
            </div>
        </div>

        <h5> Availability as a volunteer: </h5>
        <br>
        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="work_hours"> Available hours per week </label>
                {!! Form::number('work_hours',null,['class'=>'form-control','id'=>'work_hours','required' => 'required']) !!}
                {{-- <input type="number" name="work_hours" class="form-control" id="work_hours"> --}}
            </div>

            <div class="col-xs-12 col-md-6">
                {!! Form::label('workplace','Workplace :') !!}
                {!! Form::select('work_place',['o'=>'Online','f'=>'Offline','b'=>'both'],null,['class'=>'form-control','required' => 'required']) !!}
            </div>

            <div class="col-xs-12">
                <label for="work_days"> Preferred days </label>
                <div class="preferred">
                    <?php $counter = 0; ?>
                    @foreach($weak_days as $k => $day)
                        <?php $counter++ ?>
                        <div class="checkbox">
                            {!! Form::checkbox('work_days[]',$k,false,['id'=>'DayDay_'.$counter]) !!}
                            {{-- <input type="checkbox" name="work_days[]" value="{{ $k }}" id="DayDay_{{ $counter }}"> --}}
                            <label for="DayDay_{{ $counter }}">{{ $day }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <label for=""> preferred Time </label>

            <div class="col-xs-12 col-md-6">
                <label for="time_from"> From </label>
                {!! Form::text('work_time_from',null,['class'=>'form-control timepicker','id'=>'time_from','required' => 'required']) !!}
                {{-- <input type="text" name="work_time_from" class="form-control timepicker" id="time_from"> --}}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="time_to"> To </label>
                {!! Form::text('work_time_to',null,['class'=>'form-control timepicker','id'=>'time_to','required' => 'required']) !!}
                {{-- <input type="text" name="work_time_to" class="form-control timepicker" id="time_to"> --}}
            </div>

        </div>

        <h5> Upload: </h5>
        <br>

        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="profile"> Profile </label>
                <input type="file" name="profile" class="form-control" id="profile" required>
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="cv"> C.V </label>
                <input type="file" name="cv" class="form-control" id="cv" required>
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="cover_letter"> Cover Letter </label>
                <input type="file" name="cover_letter" class="form-control" id="cover_letter" required>
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="other_doc"> Other documents </label>
                <input type="file" name="other_doc" class="form-control" id="other_doc" required>
            </div>

        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="password"> Password * </label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="col-xs-12 col-md-6">
                <label for="password"> password Confirmation * </label>
                <input type="password" name="password_confirmation" class="form-control" id="linked_in" required>
            </div>
            <div class="col-xs-12">
                <label for="linked_in"> </label>
                <div class="checkbox"><input type="checkbox" name="agree" value="y" id="agree" required><label for="agree">I
                        agree with all terms and conditions <a href="#" class="agree">(Read terms and
                            conditions)</a>*</label></div>
            </div>
        </div>

        <input type="submit" value="submit" class="btn bt-default">

        {!! Form::close() !!}
    </div>

@stop
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2({
                tags: true
            });
            $('.agree').on('click', function (e) {
                e.preventDefault();
            })
            $('input.timepicker').timepicker({});

        });
    </script>
@stop
@section('page_scripts')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@stop