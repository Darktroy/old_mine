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
            <h6 class="panel-title">Edit Offer</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>

        <div class="panel-body posts_form">

            {!! Form::model($offer) !!}
                @include('common.offer_form',['offer_countries'=>$offer->offerCountries->pluck('id')->toArray(),'offerSectors'=>$offer->offerSectors->pluck('id')->toArray()])
                <div class="checkbox" style="display: inline;">
                    {!! Form::checkbox('status','1',null,['id'=>'active']) !!}
                    <label for="active" style="padding-left: 5px;">Active</label>
                </div>
                
                <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
    <!-- /profile info -->

@stop


