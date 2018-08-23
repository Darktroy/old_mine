@extends('layouts.site.changemaker')
@section('maker_content')
    <!-- Profile info -->

    @if($errors->any())
        @include('errors.list')
    @endif

    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span>
            </button>
            {{ session('message') }}
        </div>
    @endif

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Profile information</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!! Form::model($changemaker,['files'=>true]) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>last Name</label>
                        {!! Form::text('last_name',null,['form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        <label>First Name</label>
                        {!! Form::text('first_name',null,['form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Email</label>
                        {!! Form::email('email',null,['form-control']) !!}
                    </div>

                    <div class="col-md-4">
                        <label>Job Title</label>
                        {!! Form::text('job_title',null,['form-control']) !!}
                    </div>

                    <div class="col-md-4">
                        <label>private Link</label>
                        {!! Form::text('private_link',null,['form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label>Nationality</label>
                        {!! Form::text('nationality',null,['form-control']) !!}
                    </div>
                    <div class="col-md-4">
                        <label>Country</label>
                        {!! Form::select('country_id',[''=>'Select Country'] + $countries,null,['class'=>'form-control select countries_list','data-url'=>url('countries/getcities/')]) !!}
                    </div>
                    <div class="col-md-4">
                        <label>City</label>
                        {!! Form::select('city_id',[''=>'Select City'] + $cities,null,['class'=>'form-control select cities_list']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label>Address</label>
                        {!! Form::text('address',null,['form-control']) !!}
                    </div>
                    <div class="col-md-6">
                        <label>Phone</label>
                        {!! Form::text('phone',null,['form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="gender"> Gender * </label>
                        {!! Form::select('gender',['m'=>'Male','f'=>'Female'],null,['class'=>'form-control']) !!}
                    </div>

                    <div class="col-md-6 col-xs-12">
                        {!! Form::label('birth_date','Birth Date:') !!}
                        <div class=" input-group date">
                            {!! Form::text('birth_date',date('Y-m-d',strtotime($changemaker->birth_date)),['class'=>'datepicker form-control']) !!}
                            {{--<input type="text" name="established" class="datepicker form-control">--}}
                            <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="work_hours"> Available hours per week </label>
                        {!! Form::number('work_hours',null,['class'=>'form-control','id'=>'work_hours']) !!}
                        {{-- <input type="number" name="work_hours" class="form-control" id="work_hours"> --}}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        {!! Form::label('workplace','Workplace :') !!}
                        {!! Form::select('work_place',['o'=>'Online','f'=>'Offline','b'=>'both'],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="time_from"> From </label>
                        {!! Form::text('work_time_from',null,['class'=>'form-control timepicker','id'=>'time_from']) !!}
                        {{-- <input type="text" name="work_time_from" class="form-control timepicker" id="time_from"> --}}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label for="time_to"> To </label>
                        {!! Form::text('work_time_to',null,['class'=>'form-control timepicker','id'=>'time_to']) !!}
                        {{-- <input type="text" name="work_time_to" class="form-control timepicker" id="time_to"> --}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        <label for="interests"> Interests </label>
                        {!! Form::textarea('interests',null,['rows'=>'5']) !!}
                    </div>
                    <div class="col-xs-6">
                        <label for="skills"> Skills</label>
                        {!! Form::textarea('skills',null,['rows'=>'5']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <label for="facebook"> Facebook Url </label>
                        {!! Form::url('facebook',null,['class'=>'form-control','id'=>'facebook']) !!}
                        {{-- <input type="url" name="facebook" class="form-control" id="facebook"> --}}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label for="linked_in"> Linkedin Url </label>
                        {!! Form::url('linked_in',null,['class'=>'form-control','id'=>'linked_in']) !!}
                        {{-- <input type="url" name="linked_in" class="form-control" id="linked_in"> --}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="sector_interests">Sectors of Interest: * </label>
                        {!! Form::select('sector_interests[]',$sectors,$user_interests,['class'=>'form-control','multiple'=>'multiple']) !!}
                    </div>

                    <div class="col-md-6">
                        <label class="display-block">Upload profile image</label>
                        <input type="file" name="profile" class="file-styled">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i>
                </button>
            </div>
            </form>
        </div>
    </div>
    <!-- /profile info -->


    <!-- Password settings -->
    {{-- Include Password Section --}}
    @include('layouts/site/update_password',['user_type'=>'changemaker'])
    <!-- /Password settings -->
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('select').select2();
        $('input.timepicker').timepicker({});
    </script>
@stop


