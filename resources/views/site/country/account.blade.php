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
        <div class="panel-heading">
            <h6 class="panel-title">Profile information</h6>
            <a href="{{ url('account/pdf') }}" class="badge badge-primary"> <i class="fa fa-user"> </i> Save as pdf</a>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!! Form::model($user,['url'=>url('country/organization/edit/'.$details->id),'method' => 'POST','enctype'=>'multipart/form-data','class'=>'country_update']) !!}
            <div class="form-group">
                <div class="row">
                    <img src="{{ ( isset($details->logo) && !empty($details->logo)) ? asset('media/files/'.$details->logo) : '' }}"
                         alt="" class="img-responsive" width="15%" height="5%">
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('name','Organization Name: ') !!}
                        {!! Form::text('name',$details->organizations->org_name,['class'=>'','disabled']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('email','Email/Username: ') !!}
                        {!! Form::email('email',null,['class'=>'']) !!}
                    </div>
                </div>
            </div>

            {{--<div class="form-group">--}}
            {{--<div class="row">--}}
            {{--<div class="col-md-6">--}}
            {{--<label for="national"> Nationality </label>--}}
            {{--<input type="text" name="nationality"--}}
            {{--value="{{ $user->country->nationality }}" class="form-group" disabled>--}}
            {{--</div>--}}
            {{--<div class="col-md-6">--}}
            {{--<label for="phone_code"> Phone Code </label>--}}

            {{--<input type="text" name="phone_code"--}}
            {{--value="{{ $user->country->phone_code }}" class="form-group" disabled>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}


            {{--  <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label class="display-block">Upload Flag</label>
                        <input type="file" name="flag" class="file-styled">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                    </div>
                </div>
            </div>  --}}

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="Description"> National Organization Description </label>
                        {!! Form::textarea('about_us',$details->about_us,['class'=>'form-control add_tiny']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="Description"> Country Description </label>
                        <h3> {!! Form::textarea('about_us',$user->country->description,['class'=>'','disabled']) !!}</h3>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i>
                </button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
    <!-- /profile info -->

    @if(auth()->user()->type != 4)
        <!-- Password settings -->
        {{-- Include Password Section --}}
        @include('layouts/site/update_password',['user_type'=>'country'])
    @endif
    <!-- /Password settings -->
@stop

@section('scripts')
    @if(auth()->user()->type == 4)
        <script>
            $('form.country_update :input').attr('disabled', true);
        </script>
    @endif
    {{--  <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('panel/tinymce/tinymce.min.js') }}"></script>
    <script>
        $('select').select2();
        $('input.timepicker').timepicker({});

        tinymce.init({
            selector: '.add_tiny',
            height: 250,
            width: 100 + '%',
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>  --}}
@stop

