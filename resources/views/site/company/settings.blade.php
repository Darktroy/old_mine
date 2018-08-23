@extends('layouts.site.company')
@section('profile_pages')
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


    <div class="panel panel-flat " id="settings">
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
            {!! Form::model($company,['files'=>true]) !!}
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
                    {!! Form::select('city_id',[''=>'select City']+$cities,null,['class'=>'form-control cities_list']) !!}
                </div>

            </div>
            <div id="address">
                <address-comp v-for="(item , k) in address" v-bind:name-count="item" v-bind:index="k+1"
                              v-bind:types="types"></address-comp>

                <button class="btn btn-primary" @click.prevent="addAddress()"> add more Address</button>
            </div>
            <br>
            <br>

            {{--  Phones And Faxes --}}
            <div class="form-group">
                <div class="col-xs-12 col-md-6">
                    <div class="phones-container">
                        @if(isset($company->phones) && !empty($company->phones))
                            @foreach($company->phones as $phone)
                                <div class="phones">
                                    <label for="phone"> Phone * </label>
                                    <input type="text" name="phones[]" value="{{ $phone->number }}" id="">
                                </div>
                            @endforeach
                        @else
                            <div class="phones">
                                <label for="phone"> Phone * </label>
                                <input type="text" name="phones[]" id="">
                            </div>
                        @endif

                    </div>
                    <button class="btn btn-primary new_phone"> add more Phone</button>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="faxes-container">
                        @if(isset($company->faxes) && !empty($company->faxes))
                            @foreach($company->faxes as $fax)
                                <div class="faxes">
                                    <label for="faxes"> Fax * </label>
                                    <input type="text" name="faxes[]" value="{{ $fax->number }}" id="">
                                </div>
                            @endforeach
                        @else
                            <div class="faxes">
                                <label for="faxes"> Fax * </label>
                                <input type="text" name="faxes[]" id="">
                            </div>
                        @endif
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
                    {!! Form::select('person_title',['mr'=>'MR','mrs'=>'Mrs','ms'=>'MS','dr'=>'DR'],(isset($company->person) && !empty($company->person)) ? $company->person->title : null,['class'=>'form-control']) !!}
                </div>
                <div class="col-md-4 col-xs-12">
                    <label for="person_lname"> Last Name</label>
                    {!! Form::text('person_lname',(isset($company->person) && !empty($company->person)) ? $company->person->last_name : null,['class'=>'form-control','id'=>'person_lname']) !!}
                </div>

                <div class="col-md-4 col-xs-12">
                    <label for="person_fname"> First Name</label>
                    {!! Form::text('person_fname',(isset($company->person) && !empty($company->person)) ? $company->person->first_name : null,['class'=>'form-control','id'=>'person_fname']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-xs-12">
                    <label for="position"> position :</label>
                    {!! Form::text('p_position',(isset($company->person) && !empty($company->person)) ? $company->person->position : null,['class'=>'form-control','id'=>'person_lname']) !!}
                </div>
                <div class="col-md-6 col-xs-12">
                    <label for="department"> Department:</label>
                    {!! Form::text('department',(isset($company->person) && !empty($company->person)) ? $company->person->department : null,['class'=>'form-control','id'=>'department']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-xs-12">
                    <label for="p_email"> Email :</label>
                    {!! Form::email('p_email',(isset($company->person) && !empty($company->person)) ? $company->person->email : null,['class'=>'form-control','id'=>'p_email']) !!}
                </div>

                <div class="col-md-4 col-xs-12">
                    <label for="p_tel"> TEl:</label>
                    {!! Form::text('p_tel',(isset($company->person) && !empty($company->person)) ? $company->person->phone : null,['class'=>'form-control','id'=>'p_tel']) !!}
                </div>

                <div class="col-md-4 col-xs-12">
                    <label for="p_mobil"> Mobil:</label>
                    {!! Form::text('p_mobil',(isset($company->person) && !empty($company->person)) ? $company->person->mobile : null,['class'=>'form-control','id'=>'department']) !!}
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
                            {!! Form::checkbox('company_type[]','t', (in_array('t',$company->company_type)) ? true : false, ['id'=>'trade']) !!}
                            <label for="trade" style="padding-left: 5px;">Trade Company</label>
                        </div>

                        <div class="checkbox" style="display: inline;">
                            {!! Form::checkbox('company_type[]','f',(in_array('f',$company->company_type)) ? true : false,['id'=>'factory']) !!}
                            <label for="factory" style="padding-left: 5px;">Factory</label>
                        </div>

                        <div class="checkbox" style="display: inline;">
                            {!! Form::checkbox('company_type[]','s',(in_array('s',$company->company_type)) ? true : false,['id'=>'service']) !!}
                            <label for="service" style="padding-left: 5px;">Service Company</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label for="sectors">Sectors of Work: * </label>
                    {!! Form::select('sectors[]',$sectors,$company_sectors,['class'=>'form-control sectors','multiple'=>'multiple']) !!}
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
                        {!! Form::text('established',date('Y-m-d',strtotime($company->established)),['class'=>'datepicker form-control']) !!}
                        {{--<input type="text" name="established" class="datepicker form-control">--}}
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
                            {!! Form::checkbox('product_type[]','f',(in_array('f',$company->product_type)) ? true : false,['id'=>'final']) !!}
                            <label for="final" style="padding-left: 5px;">Final Product</label>
                        </div>

                        <div class="checkbox" style="display: inline;">
                            {!! Form::checkbox('product_type[]','r',(in_array('r',$company->product_type)) ? true : false,['id'=>'raw']) !!}
                            <label for="raw" style="padding-left: 5px;">Raw Materials</label>
                        </div>

                        <div class="checkbox" style="display: inline;">
                            {!! Form::checkbox('product_type[]','s',(in_array('s',$company->product_type)) ? true : false,['id'=>'pro_service']) !!}
                            <label for="pro_service" style="padding-left: 5px;">Services</label>
                        </div>

                        <div class="checkbox" style="display: inline;">
                            {!! Form::checkbox('product_type[]','o',(in_array('o',$company->product_type)) ? true : false,['id'=>'other']) !!}
                            <label for="other" style="padding-left: 5px;">Other</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label for="product_description"> Product Description : Note ( Products or Services for
                        Export) </label>
                    {!! Form::textarea('product_description',null,['rows'=>'5']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <label for="needs"> Needs: Note (Services or imported materials,products ... etc) </label>
                    {!! Form::textarea('needs',null,['rows'=>'5']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label class="display-block">Upload profile image</label>
                        <input type="file" name="logo" class="file-styled">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label class="display-block">Other Files</label>
                        <input type="file" name="other_doc" class="file-styled">
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

    {{-- Include Password Section --}}
    @include('layouts/site/update_password',['user_type'=>'company'])


    <!-- /account settings -->

    <template id="new-address">
        <div class="form-group">

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${index}][address_type]`"> Address Type *</label>
                <select :name="`address[${index}][address_type]`" :id="`address[${index}][address_type]`"
                        class="form-control">
                    <option v-for="(key , type) in types" :value="type"
                            :selected=" type == nameCount.type_id "> @{{ key }}</option>
                    <option value="o"> Other</option>
                </select>
            </div>

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${index}][new_type]`"> Other Address Type * </label>
                <input type="text" :name="`address[${index}][new_type]`"
                       class="form-control"
                       :id="`address[${index}][new_type]`"
                       placeholder="other address Type if not found">
            </div>

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${index}][address]`"> Address * </label>
                <input type="text" :name="`address[${index}][address]`" :value="nameCount.address"
                       :id="`address[${index}][address]`"
                       class="form-control"
                       placeholder="Address Here">
            </div>

            <div class="col-xs-12 col-md-3">
                <label :for="`address[${index}][postal]`"> Address Postal </label>
                <input type="number" :name="`address[${index}][postal]`" :value="nameCount.postal"
                       :id="`address[${index}][postal]`"
                       class="form-control"
                       placeholder="Address Here">
            </div>

        </div>
    </template>

@stop

@section('scripts')
    {{--  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>  --}}
    <script src="{{ asset('site/js/company.js') }}"></script>
@stop