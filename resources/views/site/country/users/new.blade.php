@extends('layouts.site.country')
@section('country_account')
    <!-- Profile info -->

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span>
            </button>
            Some thing wrongPlease Check Fields again
        </div>
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
            <h6 class="panel-title">New User</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body posts_form">
            {!! Form::open() !!}

            {!! Form::hidden('parent_id',auth()->user()->id) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name','Name: ') !!}
                        @if ($errors->has('name'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email','Email: ') !!}
                        @if ($errors->has('email'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        {!! Form::email('email',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password','Password: ') !!}
                        @if ($errors->has('password'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <input type="password" name="password" id="" class="password form-control">

                    </div>

                    <div class="col-md-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        {!! Form::label('password_confirmation','Password Confirmation: ') !!}
                        @if ($errors->has('password_confirmation'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                        <input type="password" name="password_confirmation" id="" class="password form-control">

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('position') ? ' has-error' : '' }}">
                        {!! Form::label('position','Position: ') !!}
                        @if ($errors->has('position'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('position') }}</strong>
                            </span>
                        @endif
                        {!! Form::text('position',null,['class'=>'form-control']) !!}

                    </div>
                    <div class="col-md-6 {{ $errors->has('organization') ? ' has-error' : '' }}">
                        {!! Form::label('organization','Organization: ') !!}
                        @if ($errors->has('organization'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                        @endif
                        {!! Form::text('organization',null,['class'=>'form-control']) !!}

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 {{ $errors->has('tel') ? ' has-error' : '' }}">
                        {!! Form::label('tel','Tel: ') !!}
                        @if ($errors->has('tel'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('tel') }}</strong>
                            </span>
                        @endif
                        {!! Form::text('tel',null,['class'=>'form-control']) !!}

                    </div>
                    <div class="col-md-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                        {!! Form::label('phone','Phone: ') !!}
                        @if ($errors->has('phone'))
                            <span class="help-custom">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                        {!! Form::text('phone',null,['class'=>'form-control']) !!}

                    </div>
                </div>
            </div>


            <fieldset>
                <legend class="text-semibold">
                    <i class="icon-reading position-left"></i>
                    Add User Roles
                    <a class="control-arrow" data-toggle="collapse" data-target="#demo2">
                        <i class="icon-circle-down2"></i>
                    </a>
                </legend>
                <div class="collapse in" id="demo2">
                    @foreach($roles as $role)
                        <div class="checkbox" style="display: inline;">
                            {!! Form::checkbox('role_id[]',$role->id,null,['id'=>$role->display_name]) !!}
                            <label for="{{ $role->display_name }}"
                                   style="padding-left: 5px;">{{ $role->display_name }}</label>
                        </div>
                    @endforeach
                </div>

            </fieldset>
            <hr>
            <br>
            <div class="checkbox" style="display: inline;">
                {!! Form::checkbox('status','1',null,['id'=>'status']) !!}
                <label for="status" style="padding-left: 5px;">Active</label>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
    <!-- /profile info -->

@stop


