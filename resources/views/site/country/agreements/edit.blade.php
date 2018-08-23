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
            <h6 class="panel-title">Edit Call</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>

        <div class="panel-body posts_form">
            {!! Form::model($call,['url'=>"country/calls/$call->id/edit",'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                @include('common.calls_form',['call_countries'=>$call->callCountries->pluck('id')->toArray(),'call_cities'=>$call->callCities->pluck('id')->toArray(),'cities'=>$cities])
            {!! Form::close() !!}
        </div>
    </div>
    <!-- /profile info -->

@stop

