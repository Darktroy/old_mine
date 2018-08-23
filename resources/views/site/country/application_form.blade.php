@extends('layouts.site.inner_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('page_content')

    <div class="site_application" style="  background-color: #efefef;  padding: 60px; margin: 60px;">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

        <div class="sec-title">
            <h2 class="text-center"> Register As A National Organization </h2>
        </div>

        @include('errors.list')
        @if(session('returned_inputs'))
            <?php $related_inputs = session('returned_inputs')  ?>
        @endif
        {!! Form::open(['url'=>'country/application','method' => 'POST','enctype'=>'multipart/form-data']) !!}

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="country"> Country * </label>
                {!! Form::select('country_id',[''=>'Select Country'] + $countries,null,['class'=>'form-control countries_list','data-url'=>url('countries/getcities/')]) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="org_name"> Organization Name * </label>
                {!! Form::text('org_name',null,['class'=>'form-control','id'=>'org_name']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="web_site"> Website </label>
                {!! Form::url('website',null,['class'=>'form-control','id'=>'website']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="dep_name"> Department </label>
                {!! Form::text('dep_name',null,['class'=>'form-control','id'=>'dep_name']) !!}
            </div>
            <div class="col-xs-12 col-md-6">
                <label for="acronym"> Acronym </label>
                {!! Form::text('acronym',null,['class'=>'form-control','id'=>'acronym']) !!}
            </div>
        </div>

        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="email"> Email * </label>
                {!! Form::email('email',null,['class'=>'form-control','id'=>'email']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="p_link"> Private Link </label>
                {!! Form::text('p_link',null,['class'=>'form-control','id'=>'p_link']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="belong_to"> Belong to * </label>
                <select id="inputState" class="form-control" name="belong_to">
                    <option value=0>Private</option>
                    <option value=1>Public</option>
                    <option value=2>Other</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::text('other_sector',null,['class'=>'form-control' , 'style' => "display:none;" , 'id'=> 'other_sector','name'=>'other_sector']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="org_type"> Organization Type * </label>
                <select id="org_type" class="form-control" name="org_type">
                    <option value=0>Governmental Organization</option>
                    <option value=1>Non-Governmental Organization</option>
                    <option value=2>Other</option>
                </select>
            </div>
            <div class="col-xs-12 col-md-6">
                <label for="status"> Status * </label>
                <select id="status" class="form-control" name="status">
                    <option value="profile">profile</option>
                    <option value="non profile">non profile</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::textarea('other_org_type',null,['class'=>'form-control' , 'style' => "display:none;" , 'id'=> 'other_org_type','name'=>'other_org_type']) !!}
            </div>
        </div>


        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::label('postal_code','postal code *') !!}
                {!! Form::text('postal_code',null,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="city"> City </label>
                {!! Form::select('city_id',[''=>'select City'],null,['class'=>'form-control cities_list']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="city"> Add your city name, if it’s not listed </label>
                {!! Form::text('city_name',null,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="address"> Address * </label>
                <select id="address" class="form-control" name="address">
                    <option value=0>Headquarter</option>
                    <option value=1>Office</option>
                    <option value=2>Branch</option>
                    <option value=3>Factory</option>
                    <option value=4>Work space</option>
                    <option value=5>Other</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::text('other_address',null,['class'=>'form-control' , 'style' => "display:none;" , 'id' => 'other_address']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-8">
                <label for="level"> Manager Name * </label>
                <div class="form-input">
                    <label class="radio-inline">
                        <input type="radio" name="manager_name" value="Mr"> Mr./
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="manager_name" value="Mrs">Mrs./
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="manager_name" value="Ms"> Ms./
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="manager_name" value="Dr"> Dr./
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="first_name"> First Name * </label>
                {!! Form::text('first_name',null,['class'=>'form-control','id'=>'first_name','name'=>'first_name']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="last_name"> Last Name * </label>
                {!! Form::text('last_name',null,['class'=>'form-control','id'=>'last_name','name'=>'last_name']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="selected_by"> Selected by * </label>
                <select id="selected_by" class="form-control" name="selected_by">
                    <option value=0>Election</option>
                    <option value=1>Employee</option>
                    <option value=2>Other</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::textarea('other_selected_by',null,['class'=>'form-control' , 'style' => "display:none;" , 'id' => 'other_selected_by']) !!}
            </div>
        </div>

        @if(!isset($related_inputs) && empty($related_inputs) && empty($related_inputs['contact_phone']))
            <div class="form-group">
                <div class="col-xs-12 col-md-4">
                    <label for="tel"> Tel </label>
                    {!! Form::text('tel',null,['class'=>'form-control','id'=>'tel','name'=>'contact_phone[1][tel]']) !!}
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="ext"> Ext </label>
                    {!! Form::text('ext',null,['class'=>'form-control','id'=>'ext','name'=>'contact_phone[1][ext]']) !!}
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="phone"> Mobile Phone </label>
                    {!! Form::text('phone',null,['class'=>'form-control','id'=>'phone','name'=>'contact_phone[1][phone]']) !!}
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="fax"> Fax </label>
                    {!! Form::text('fax',null,['class'=>'form-control','id'=>'fax','name'=>'contact_phone[1][fax]']) !!}
                </div>
            </div>
        @endif

        @if(isset($related_inputs) && !empty($related_inputs) && !empty($related_inputs['contact_phone']) )
            @foreach($related_inputs['contact_phone'] as $k => $input)
                <div class="form-group">
                    <div class="col-xs-12 col-md-4">
                        <label for="tel"> Tel </label>
                        {!! Form::text('tel',null,['class'=>'form-control','id'=>'tel','name'=>"contact_phone[{{$k}}][tel]"]) !!}
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <label for="ext"> Ext </label>
                        {!! Form::text('ext',null,['class'=>'form-control','id'=>'ext','name'=>"contact_phone[{{$k}}][ext]"]) !!}
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="mobile"> Mobile Phone </label>
                        {!! Form::text('phone',null,['class'=>'form-control','id'=>'phone','name'=>"contact_phone[{{$k}}][phone]"]) !!}
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="fax"> Fax </label>
                        {!! Form::text('fax',null,['class'=>'form-control','id'=>'fax','name'=>"contact_phone[{{$k}}][fax]"]) !!}
                    </div>
                </div>
            @endforeach
        @endif

        <div class="more_contact_phones">
            <a class="btn btn-primary add_more_phones"> <i class="fa fa-plus"></i> More</a>
        </div>
        <br>
        <br>

        <div class="form-group">
            <div class="col-xs-12 col-md-4">
                <label for="facebook"> Facebook Url </label>
                {!! Form::url('facebook_link',null,['class'=>'form-control','id'=>'facebook']) !!}
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="linked_in"> Linkedin Url </label>
                {!! Form::url('linked_link',null,['class'=>'form-control','id'=>'linked_in']) !!}
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="twitter"> Twitter Url </label>
                {!! Form::url('twitter_link',null,['class'=>'form-control','id'=>'twitter']) !!}
            </div>
        </div>


        <h5> Contact Person: </h5>
        <br>

        @if(!isset($related_inputs) && empty($related_inputs) && empty($related_inputs['contact_person']))

            <div class="form-group">
                <div class="col-xs-12 col-md-8">
                    <div class="form-input" id="contact_type">
                        <label class="radio-inline">
                            <input type="radio" name="contact_person[1][contact_type]" value="0"> Mr./
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="contact_person[1][contact_type]" value="1">Mrs./
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="contact_person[1][contact_type]" value="2"> Ms./
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="contact_person[1][contact_type]" value="3"> Dr./
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="first_name"> First Name * </label>
                    {!! Form::text("contact_person[1][first_name]",null,['class'=>'form-control','id'=>'first_name','name'=>'contact_person[1][first_name]']) !!}
                </div>

                <div class="col-xs-12 col-md-6">
                    <label for="last_name"> Last Name * </label>
                    {!! Form::text("contact_person[1][last_name]",null,['class'=>'form-control','id'=>'last_name','name'=>"contact_person[1][last_name]"]) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="position"> Position * </label>
                    {!! Form::text('position',null,['class'=>'form-control','id'=>'position','name'=>'contact_person[1][position]']) !!}
                </div>

                <div class="col-xs-12 col-md-6">
                    <label for="dep_name"> Department * </label>
                    {!! Form::text('dept_name',null,['class'=>'form-control','id'=>'dep_name' , 'name'=>'contact_person[1][dept_name]']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="email"> Email * </label>
                    {!! Form::email('email',null,['class'=>'form-control','id'=>'email','name'=> 'contact_person[1][email]']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-4">
                    <label for="tel"> Tel </label>
                    {!! Form::text('tel',null,['class'=>'form-control','id'=>'tel','name'=>'contact_person[1][tel]']) !!}
                </div>
                <div class="col-xs-12 col-md-4">
                    <label for="ext"> Ext </label>
                    {!! Form::text('ext',null,['class'=>'form-control','id'=>'ext','name'=>'contact_person[1][ext]']) !!}
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="mobile"> Mobile Phone </label>
                    {!! Form::text('mobile',null,['class'=>'form-control','id'=>'mobile','name'=>'contact_person[1][mobile]']) !!}
                </div>
            </div>

        @endif
        @if(isset($related_inputs) && !empty($related_inputs) && !empty($related_inputs['contact_person']) )
            @foreach($related_inputs['contact_person'] as $k => $input)
                <div class="form-group">
                    <div class="col-xs-12 col-md-8">
                        <div class="form-input" id="contact_type">
                            <label class="radio-inline">
                                <input type="radio" name="contact_person[{{$k}}][contact_type]" value="0"> Mr./
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="contact_person[{{$k}}][contact_type]" value="1">Mrs./
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="contact_person[{{$k}}][contact_type]" value="2"> Ms./
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="contact_person[{{$k}}][contact_type]" value="3"> Dr./
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-md-6">
                        <label for="first_name"> First Name * </label>
                        {!! Form::text("contact_person[{{$k}}][first_name]",null,['class'=>'form-control','id'=>'first_name','name'=>"contact_person[{{$k}}][first_name]"]) !!}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label for="last_name"> Last Name * </label>
                        {!! Form::text("contact_person[{{$k}}][last_name]",null,['class'=>'form-control','id'=>'last_name','name'=>"contact_person[{{$k}}][last_name]"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-md-6">
                        <label for="position"> Position * </label>
                        {!! Form::text('position',null,['class'=>'form-control','id'=>'position','name'=>"contact_person[{{$k}}][position]"]) !!}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label for="dep_name"> Department * </label>
                        {!! Form::text('dept_name',null,['class'=>'form-control','id'=>'dept_name','name'=>"contact_person[{{$k}}][dept_name]"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-md-6">
                        <label for="email"> Email * </label>
                        {!! Form::text('email',null,['class'=>'form-control','id'=>'email' , 'name'=>"contact_person[{{$k}}][email]"]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-4">
                        <label for="tel"> Tel </label>
                        {!! Form::text('tel',null,['class'=>'form-control','id'=>'tel' , 'name'=>"contact_person[{{$k}}][tel]"]) !!}
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <label for="ext"> Ext </label>
                        {!! Form::text('ext',null,['class'=>'form-control','id'=>'ext' , 'name'=>"contact_person[{{$k}}][ext]"]) !!}
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="mobile"> Mobile Phone </label>
                        {!! Form::text('mobile',null,['class'=>'form-control','id'=>'mobile' , 'name'=>"contact_person[{{$k}}][mobile]"]) !!}
                    </div>
                </div>
            @endforeach
        @endif

        <div class="more_contact">
            <a class="btn btn-primary add_more_button"> <i class="fa fa-plus"></i> More</a>
        </div>
        <br>
        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::label('about_us','About us *') !!}
                {!! Form::textarea('about_us',null,['class'=>'form-control','id'=>'about_us','name'=>'about_us']) !!}
            </div>
            <div class="col-xs-12 col-md-6">
                {!! Form::label('services_desc','Services Description *') !!}
                {!! Form::textarea('services_desc',null,['class'=>'form-control','id'=>'services_desc','name'=>'services_desc']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 col-md-4">
                {!! Form::label('established','Established on (Date):') !!}
                <div class=" input-group date">
                    <input type="text" name="established" class="datepicker form-control">
                    <span class="input-group-addon">
         <i class="glyphicon glyphicon-th"></i>
        </span>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                {!! Form::label('num_of_emp','Number of Employees:') !!}
                {!! Form::text('num_of_emp',null,['class'=>'form-control','id'=>'num_of_emp','name'=>'num_of_emp']) !!}
            </div>
            <div class="col-xs-12 col-md-4">
                {!! Form::label('num_of_mem','Number of Members:') !!}
                {!! Form::text('num_of_mem',null,['class'=>'form-control','id'=>'num_of_mem','name'=>'num_of_mem']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::label('suggested','Your suggested contribution: *') !!}
                {!! Form::textarea('suggested_contribution',null,['class'=>'form-control','id'=>'suggested','name'=>'suggested_contribution' , 'placeholder' => 'e.i. (Donations, Technical support, Marketing, News, Data or Information, etc.)']) !!}
            </div>

            {{--<div class="col-xs-12 col-md-6">--}}
            {{--{!! Form::label('support','How can you support us? *') !!}--}}
            {{--{!! Form::textarea('support_us',null,['class'=>'form-control' , 'id'=> 'support' , 'name'=> 'support_us' , 'placeholder' => 'e.i. (Donations, Technical support, Marketing, News, Data or Information, etc.)']) !!}--}}
            {{--</div>--}}
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::label('organize_social','Can you organize a social campaign for "Made in EuroMed" idea? *') !!}
                <div class="form-input" id="organize_social">
                    <label class="radio-inline">
                        <input type="radio" id="no" name="check_social" value="0"> No
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="yes" name="check_social" value="1"> Yes
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::textarea('organize_social_yes',null,['class'=>'form-control' , 'name' => 'suggest_plan' , 'style' => "display:none;" , 'id' => 'organize_social_yes', 'placeholder' => 'The suggested plan']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::textarea('organize_social_no',null,['class'=>'form-control' , 'name' => 'clarifications' , 'style' => "display:none;" , 'id' => 'organize_social_no' , 'placeholder' => 'I need more clarifications']) !!}
            </div>
        </div>

        <h5> Upload: </h5>
        <br>

        @if(!isset($related_inputs) && empty($related_inputs) && empty($related_inputs['upload']))
            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="logo"> Logo * </label>
                    <input type="file" name="logo" class="form-control" id="logo">
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="other_doc"> Other documents </label>
                    <input type="file" name="other_doc" class="form-control" id="other_doc">
                    <small> e.i cover letter, rigistration ducoments</small>
                </div>
            </div>
            <div class="add_more_doc">
                <a class="btn btn-primary add_more"> <i class="fa fa-plus"></i> More Documentations</a>
            </div>
            <br>
        @endif

        <br>
        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                {!! Form::label('login_email','Login Email *') !!}
                {!! Form::email('login_email',null,['class'=>'form-control','id'=>'login_email']) !!}
            </div>

            <div class="col-xs-12 col-md-6">
                {!! Form::label('login_Password','Login Password *') !!}
                {!! Form::password('login_Password',null,['class'=>'form-control','id'=>'login_Password']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox"><input type="checkbox" name="agree" value="y" id="agree">
                <label for="agree">I agree with all terms and conditions <a href="#" class="agree">(Read terms and
                        conditions)</a>*</label>
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Register',['class' => 'btn btn-info active']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/country.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/add_more.js') }}"></script>
@stop
@section('page_scripts')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@stop