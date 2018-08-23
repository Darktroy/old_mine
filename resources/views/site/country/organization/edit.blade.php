@extends('layouts.site.country')
@section('country_account')
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
        <div class="thumb content-group">
            <img src="{{ ( isset($Organization->organizationDetails->logo) &&
            !empty($Organization->organizationDetails->logo)) ? asset('media/files/'.$Organization->organizationDetails->logo) : '' }}"
                 alt="" class="img-responsive" style="width: 200px; height: 300px">
        </div>
        <div class="panel-heading">
            <h6 class="panel-title">Edit Organization</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="reload"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body posts_form">

            {!! Form::model($Organization,['url'=>"country/organization/$Organization->id/edit",'method' => 'POST','enctype'=>'multipart/form-data']) !!}

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="org_name"> Organization Name * </label>
                    {!! Form::text('org_name',$Organization->org_name,['class'=>'form-control','id'=>'org_name','disabled']) !!}
                </div>

                <div class="col-xs-12 col-md-6">
                    <label for="web_site"> Web Site </label>
                    {!! Form::url('website',$Organization->website,['class'=>'form-control','id'=>'website','disabled']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="country"> Country </label>
                    {!! Form::text('country_name',$Organization->country->name,['class'=>'form-control','id'=>'country_name','disabled']) !!}
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="country"> City </label>
                    {!! Form::text('city_name',$Organization->city->name,['class'=>'form-control','id'=>'city_name','disabled']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="dep_name"> Department </label>
                    {!! Form::text('dep_name',$Organization->dep_name,['class'=>'form-control','id'=>'dep_name','disabled']) !!}
                </div>
                <div class="col-xs-12 col-md-6">
                    <label for="acronym"> Acronym </label>
                    {!! Form::text('acronym',$Organization->acronym,['class'=>'form-control','id'=>'acronym','disabled']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="org_type"> Organization Type * </label>
                    <select id="org_type" class="form-control" name="org_type">
                        <option value=0>{!! $Organization->org_type !!}</option>
                        <option value=0>Governmental Organization</option>
                        <option value=1>Non-Governmental Organization</option>
                        <option value=2>Other</option>
                    </select>
                </div>
                <div class="col-xs-12 col-md-6">
                    {!! Form::label('established','Established on (Date): *') !!}
                    <div class=" input-group date">
                        <input type="text" name="established" class="datepicker form-control"
                               value={!! $Organization->organizationDetails->established_on !!} disabled>
                        <span class="input-group-addon">
         <i class="glyphicon glyphicon-th"></i>
        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="email"> Email * </label>
                    {!! Form::email('email',$Organization->email,['class'=>'form-control','id'=>'email']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <label for="first_name"> First Name * </label>
                    {!! Form::text('first_name',$Organization->first_name,['class'=>'form-control','id'=>'first_name','name'=>'first_name']) !!}
                </div>

                <div class="col-xs-12 col-md-6">
                    <label for="last_name"> Last Name * </label>
                    {!! Form::text('last_name',$Organization->last_name,['class'=>'form-control','id'=>'last_name','name'=>'last_name']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-4">
                    <label for="facebook"> Facebook Url </label>
                    {!! Form::url('facebook_link',$Organization->facebook,['class'=>'form-control','id'=>'facebook']) !!}
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="linked_in"> Linkedin Url </label>
                    {!! Form::url('linked_link',$Organization->linkedin,['class'=>'form-control','id'=>'linked_in']) !!}
                </div>

                <div class="col-xs-12 col-md-4">
                    <label for="twitter"> Twitter Url </label>
                    {!! Form::url('twitter_link',$Organization->twitter,['class'=>'form-control','id'=>'twitter']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    {!! Form::label('about_us','About us *') !!}
                    {!! Form::textarea('about_us',$Organization->organizationDetails->about_us,['class'=>'form-control','id'=>'about_us','name'=>'about_us']) !!}
                </div>
                <div class="col-xs-12 col-md-6">
                    {!! Form::label('services_desc','Services Description *') !!}
                    {!! Form::textarea('services_desc',$Organization->organizationDetails->services_desc,['class'=>'form-control','id'=>'services_desc','name'=>'services_desc']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    {!! Form::label('num_of_emp','Number of Employees: *') !!}
                    {!! Form::text('num_of_emp',$Organization->organizationDetails->no_of_emp,['class'=>'form-control','id'=>'num_of_emp','name'=>'num_of_emp']) !!}
                </div>
                <div class="col-xs-12 col-md-6">
                    {!! Form::label('num_of_mem','Number of Members: *') !!}
                    {!! Form::text('num_of_mem',$Organization->organizationDetails->no_of_mem,['class'=>'form-control','id'=>'num_of_mem','name'=>'num_of_mem']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    {!! Form::label('suggested','Your suggested contribution: *') !!}
                    {!! Form::textarea('suggested_contribution',$Organization->organizationDetails->suggested_contribution,['class'=>'form-control','id'=>'suggested','name'=>'suggested_contribution']) !!}
                </div>

                <div class="col-xs-12 col-md-6">
                    {!! Form::label('support','How can you support us? *') !!}
                    {!! Form::textarea('support_us',$Organization->organizationDetails->support_us,['class'=>'form-control' , 'id'=> 'support' , 'name'=> 'support_us' , 'placeholder' => 'e.i. (Donations, Technical support, Marketing, News, Data or Information, etc.)']) !!}
                </div>
            </div>

            @if(!empty($Organization->organizationDetails->clarifications))
                <div class="form-group">
                    <div class="col-xs-12 col-md-6">
                        {!! Form::textarea('organize_social_no',$Organization->organizationDetails->clarifications,['class'=>'form-control' , 'name' => 'clarifications' ,'id' => 'organize_social_no']) !!}
                    </div>
                </div>
            @endif

            <h5> Contact Person: </h5>
            <br>

            @foreach($Organization->organizationContactPerson as $contact)
                <div class="form-group">
                    <div class="col-xs-12 col-md-6">
                        <label for="first_name"> First Name * </label>
                        {!! Form::text("contact_person[1][first_name]",$contact->first_name,['class'=>'form-control','id'=>'first_name','name'=>'organization_contact_person[1][first_name]']) !!}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label for="last_name"> Last Name * </label>
                        {!! Form::text("contact_person[1][last_name]",$contact->last_name,['class'=>'form-control','id'=>'last_name','name'=>"organization_contact_person[1][last_name]"]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-6">
                        <label for="position"> Position </label>
                        {!! Form::text('position',$contact->position,['class'=>'form-control','id'=>'position','name'=>'organization_contact_person[1][position]']) !!}
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label for="dep_name"> Department </label>
                        {!! Form::text('dept_name',$contact->department,['class'=>'form-control','id'=>'dep_name' , 'name'=>'organization_contact_person[1][dept_name]']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-6">
                        <label for="email"> Email * </label>
                        {!! Form::email('email',$contact->email,['class'=>'form-control','id'=>'email','name'=> 'organization_contact_person[1][email]']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-md-4">
                        <label for="tel"> Tel </label>
                        {!! Form::text('tel',$contact->tel,['class'=>'form-control','id'=>'tel','name'=>'organization_contact_person[1][tel]']) !!}
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <label for="ext"> Ext </label>
                        {!! Form::text('ext',$contact->ext,['class'=>'form-control','id'=>'ext','name'=>'organization_contact_person[1][ext]']) !!}
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="mobile"> Mobile Phone </label>
                        {!! Form::text('mobile',$contact->mobile,['class'=>'form-control','id'=>'mobile','name'=>'organization_contact_person[1][mobile]']) !!}
                    </div>
                </div>
            @endforeach

            <h5> Organization Contact Phones: </h5>
            <br>
            @foreach($Organization->organizationContacts as $contact)
                <div class="form-group">
                    <div class="col-xs-12 col-md-4">
                        <label for="tel"> Tel </label>
                        {!! Form::text('tel',$contact->tel,['class'=>'form-control','id'=>'tel','name'=>'organization_contacts[1][tel]']) !!}
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="ext"> Ext </label>
                        {!! Form::text('ext',$contact->ext,['class'=>'form-control','id'=>'ext','name'=>'organization_contacts[1][ext]']) !!}
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="mobile"> Mobile Phone </label>
                        {!! Form::text('mobile',$contact->mobile,['class'=>'form-control','id'=>'mobile','name'=>'organization_contacts[1][mobile]']) !!}
                    </div>

                    <div class="col-xs-12 col-md-4">
                        <label for="mobile"> Fax </label>
                        {!! Form::text('mobile',$contact->fax,['class'=>'form-control','id'=>'mobile','name'=>'organization_contacts[1][mobile]']) !!}
                    </div>
                </div>
            @endforeach

            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@stop
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
@stop
@section('page_scripts')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@stop