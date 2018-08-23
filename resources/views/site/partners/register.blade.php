@extends('layouts.site.inner_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('page_content')


    <div class="site_login" id="register">

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                </button>
                {{ session('message') }}
            </div>
        @endif

        <div class="sec-title">
            <h2 class="text-center"> Register As Company </h2>
        </div>

        @include('errors.list')

        {!! Form::open(['files'=>true]) !!}

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="last_name"> name </label>
                {!! Form::text('name',null,['class'=>'form-control','id'=>'name']) !!}
                {{-- <input type="text" name="last_name" class="form-control" id="last_name"> --}}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="web_site"> Web Site </label>
                {!! Form::url('website',null,['class'=>'form-control','id'=>'website']) !!}
                {{-- <input type="text" name="first_name" class="form-control" id="first_name"> --}}
            </div>
        </div>

        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="email"> Email * </label>
                {!! Form::email('email',null,['class'=>'form-control','id'=>'email']) !!}
                {{-- <input type="email" name="email" class="form-control" id="email"> --}}
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="p_link"> Private Link * </label>
                {!! Form::text('p_link',null,['class'=>'form-control','id'=>'p_link']) !!}
                {{-- <input type="text" name="p_link" class="form-control" id="p_link"> --}}
            </div>

        </div>

        <div class="form-group">

            <div class="col-xs-12 col-md-4">
                <label for="belongs_to"> Belong To * </label>
                {!! Form::select('belongs_to',['p'=>'Public Sector','v'=>'Private Sector'],null,['class'=>'form-control']) !!}
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="gender"> Country * </label>
                {!! Form::select('country_id',[''=>'Select Country'] + $countries,null,['class'=>'form-control countries_list','data-url'=>url('countries/getcities/')]) !!}
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="city"> City * </label>
                {!! Form::select('city_id',[''=>'select City'],null,['class'=>'form-control cities_list']) !!}
            </div>

        </div>

        {{-- Phones --}}
        <address-comp v-for="count in counts" v-bind:name-count="count"></address-comp>

        <button class="btn btn-primary" @click.prevent="addAddress()"> add more Address</button>

        <br>
        <br>

        {{--  Phones And Faxes --}}
        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <div class="phones-container">
                    <div class="phones">
                        <label for="phone"> Phone * </label>
                        <input type="text" name="phones[]" id="">
                    </div>
                </div>
                <button class="btn btn-primary new_phone"> add more Phone</button>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="faxes-container">
                    <div class="faxes">
                        <label for="faxes"> Fax * </label>
                        <input type="text" name="faxes[]" id="">
                    </div>
                </div>
                <button class="btn btn-primary new_fax"> add more FAX</button>
            </div>

        </div>

        {{-- Social Urls --}}

        <br>
        <br>
        <h5> Social Links: </h5>
        <br>
        <br>
        <div class="form-group">
            <div class="col-xs-12 col-md-4">
                <label for="facebook"> Facebook Url </label>
                {!! Form::url('facebook',null,['class'=>'form-control','id'=>'facebook']) !!}
                {{-- <input type="url" name="facebook" class="form-control" id="facebook"> --}}
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="linked_in"> Linkedin Url </label>
                {!! Form::url('linked_in',null,['class'=>'form-control','id'=>'linked_in']) !!}
                {{-- <input type="url" name="linked_in" class="form-control" id="linked_in"> --}}
            </div>

            <div class="col-xs-12 col-md-4">
                <label for="linked_in"> Twitter </label>
                {!! Form::url('twitter',null,['class'=>'form-control','id'=>'twitter']) !!}
                {{-- <input type="url" name="linked_in" class="form-control" id="linked_in"> --}}
            </div>

        </div>

        <br>
        <br>
        <h5> Contact Person: </h5>
        <br>
        <br>

        <div class="form-group">
            <div class="col-md-4 col-xs-12">
                <label for="person_lname"> Title: </label>
                <select name="person_title" id="person_title" class="form-control">
                    <option value="mr"> Mr.</option>
                    <option value="mrs">Mrs</option>
                    <option value="ms">MS</option>
                    <option value="dr">DR</option>
                </select>
            </div>
            <div class="col-md-4 col-xs-12">
                <label for="person_lname"> Last Name</label>
                {!! Form::text('person_lname',null,['class'=>'form-control','id'=>'person_lname']) !!}
            </div>

            <div class="col-md-4 col-xs-12">
                <label for="person_fname"> First Name</label>
                {!! Form::text('person_fname',null,['class'=>'form-control','id'=>'person_fname']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-xs-12">
                <label for="position"> position :</label>
                {!! Form::text('p_position',null,['class'=>'form-control','id'=>'person_lname']) !!}
            </div>
            <div class="col-md-6 col-xs-12">
                <label for="department"> Department:</label>
                {!! Form::text('department',null,['class'=>'form-control','id'=>'department']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 col-xs-12">
                <label for="p_email"> Email :</label>
                {!! Form::email('p_email',null,['class'=>'form-control','id'=>'p_email']) !!}
            </div>

            <div class="col-md-4 col-xs-12">
                <label for="p_tel"> TEl:</label>
                {!! Form::text('p_tel',null,['class'=>'form-control','id'=>'p_tel']) !!}
            </div>

            <div class="col-md-4 col-xs-12">
                <label for="p_mobil"> Mobil:</label>
                {!! Form::text('p_mobil',null,['class'=>'form-control','id'=>'department']) !!}
            </div>

        </div>

        <br>
        <br>
        <h5> Company Details: </h5>
        <br>
        <br>

        <div class="form-group">
            <div class="col-xs-12">
                <label> Company Type : </label>
                <div class="preferred">
                    <div class="checkbox" style="display: inline;">
                        {!! Form::checkbox('company_type[]','t',false,['id'=>'trade']) !!}
                        <label for="trade" style="padding-left: 5px;">Trade Company</label>
                    </div>

                    <div class="checkbox" style="display: inline;">
                        {!! Form::checkbox('company_type[]','f',false,['id'=>'factory']) !!}
                        <label for="factory" style="padding-left: 5px;">Factory</label>
                    </div>

                    <div class="checkbox" style="display: inline;">
                        {!! Form::checkbox('company_type[]','s',false,['id'=>'service']) !!}
                        <label for="service" style="padding-left: 5px;">Service Company</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <label for="interest">Sectors of Work: * </label>
                {!! Form::select('sectors[]',$sectors,null,['class'=>'form-control firstList','multiple'=>'multiple']) !!}

            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <label for="about"> About Company : </label>
                {!! Form::textarea('about',null,['rows'=>'5']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-xs-12">
                {!! Form::label('established','Established on :') !!}
                <div class=" input-group date">
                    <input type="text" name="established" class="datepicker form-control">
                    <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th"></i>
                                </span>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <label for="employees"> Number of Employees: </label>
                {!! Form::number('employees',null,['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <label for=""> Annual Turn Over : </label>
            </div>
            <div class="annual">
                <div class="col-md-6 col-xs-12">
                    <label for="from"> From: </label>
                    {!! Form::number('turn_over_from',null,['class'=>'form-control']) !!}
                </div>

                <div class="col-md-6 col-xs-12">
                    <label for="to"> To: </label>
                    {!! Form::number('turn_over_to',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <label> Product Type : </label>
                <div class="preferred">
                    <div class="checkbox" style="display: inline;">
                        {!! Form::checkbox('product_type[]','f',false,['id'=>'final']) !!}
                        <label for="final" style="padding-left: 5px;">Final Product</label>
                    </div>

                    <div class="checkbox" style="display: inline;">
                        {!! Form::checkbox('product_type[]','r',false,['id'=>'raw']) !!}
                        <label for="raw" style="padding-left: 5px;">Raw Materials</label>
                    </div>

                    <div class="checkbox" style="display: inline;">
                        {!! Form::checkbox('product_type[]','s',false,['id'=>'pro_service']) !!}
                        <label for="pro_service" style="padding-left: 5px;">Services</label>
                    </div>

                    <div class="checkbox" style="display: inline;">
                        {!! Form::checkbox('product_type[]','o',false,['id'=>'other']) !!}
                        <label for="other" style="padding-left: 5px;">Other</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <label for="product_description"> Product Description : Note ( Products or Services for Export) </label>
                {!! Form::textarea('product_description',null,['rows'=>'5']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <label for="needs"> Needs: Note (Services or imported materials,products ... etc) </label>
                {!! Form::textarea('needs',null,['rows'=>'5']) !!}
            </div>
        </div>

        <h5> Upload: </h5>
        <br>

        <div class="form-group">

            <div class="col-xs-12 col-md-6">
                <label for="logo"> Logo :</label>
                <input type="file" name="logo" class="form-control" id="profile">
            </div>

            <div class="col-xs-12 col-md-6">
                <label for="other_doc"> Other documents </label>
                <input type="file" name="other_doc" class="form-control" id="other_doc">
            </div>

        </div>

        <div class="form-group">
            <div class="col-xs-12 col-md-6">
                <label for="password"> Password * </label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="col-xs-12 col-md-6">
                <label for="password"> password Confirmation * </label>
                <input type="password" name="password_confirmation" class="form-control" id="linked_in">
            </div>
            <div class="col-xs-12">
                <label for="linked_in"> </label>
                <div class="checkbox"><input type="checkbox" name="agree" value="y" id="agree"><label for="agree">I
                        agree with all terms and conditions <a href="#" class="agree">(Read terms and
                            conditions)</a>*</label></div>
            </div>
        </div>

        <input type="submit" value="submit" class="btn bt-default">

        {!! Form::close() !!}
    </div>

    <template id="new-address">
        <div class="form-group">

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${nameCount}][address_type]`"> Address Type *</label>
                <select :name="`address[${nameCount}][address_type]`" :id="`address[${nameCount}][address_type]`"
                        class="form-control">
                    @foreach($address_types as $k => $type)
                        <option value="{{ $k }}"> {{ $type }} </option>
                    @endforeach
                    <option value="o"> Other</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${nameCount}][new_type]`"> Other Address Type * </label>
                <input type="text" :name="`address[${nameCount}][new_type]`" class="form-control"
                       :id="`address[${nameCount}][new_type]`"
                       placeholder="other address Type if not found">
            </div>

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${nameCount}][address]`"> Address * </label>
                <input type="text" :name="`address[${nameCount}][address]`" :id="`address[${nameCount}][address]`"
                       class="form-control"
                       placeholder="Address Here">
            </div>

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${nameCount}][postal]`"> Address Postal </label>
                <input type="number" :name="`address[${nameCount}][postal]`" :id="`address[${nameCount}][postal]`"
                       class="form-control"
                       placeholder="Address Here">
            </div>

        </div>
    </template>
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
    <script src="{{ asset('site/js/company.js') }}"></script>
@stop
{{--  @section('page_scripts')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@stop  --}}