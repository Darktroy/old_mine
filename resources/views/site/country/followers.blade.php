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
    <div class="panel-heading">
        <a href="{{url('organization/export/'.$country_id)}}" class="btn btn-default"><b style="color: black"> Export
                Followers </b></a>
    </div>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title"><b> Change Makers users </b></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr class="headings">
                        <td class="column-title"> Name</td>
                        <td class="column-title"> Email</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($changeMakers))
                        @foreach($changeMakers as $data)
                            <tr>
                                <td class="heading-form">{{$data->name}}</td>
                                <td class="heading-form">{{$data->email}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title"><b> Companies users </b></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr class="headings">
                        <td class="column-title"> Name</td>
                        <td class="column-title"> Email</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($companies))
                        @foreach($companies as $data)
                            <tr>
                                <td class="heading-form">{{$data->name}}</td>
                                <td class="heading-form">{{$data->email}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title"><b>Partners users</b></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr class="headings">
                        <td class="column-title"> Name</td>
                        <td class="column-title"> Email</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($partners))
                        @foreach($partners as $data)
                            <tr>
                                <td class="heading-form">{{$data->name}}</td>
                                <td class="heading-form">{{$data->email}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title"><b>Countries Admins users</b></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr class="headings">
                        <td class="column-title"> Name</td>
                        <td class="column-title"> Email</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($countriesAdmins))
                        @foreach($countriesAdmins as $data)
                            <tr>
                                <td class="heading-form">{{$data->name}}</td>
                                <td class="heading-form">{{$data->email}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /profile info -->
@stop

@section('scripts')
@stop

