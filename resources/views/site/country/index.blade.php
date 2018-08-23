@extends('layouts.site.inner_pages_layout')
@section('page_content')
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

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <ul class="pagination pagination-split">
                @if(!empty(auth()->user()))
                    @if(auth()->user()->type == 0)
                        <li><a href="{{ url('panel/countries/') }}">All</a></li>
                    @else
                        <li><a href="{{ url('countries') }}">All</a></li>
                    @endif
                @else
                    <li><a href="{{ url('countries') }}">All</a></li>
                @endif
                @foreach(range('A', 'Z') as $chr)
                    <li><a href="{{ url('countries/'.$chr) }}">{{ $chr }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <br>
    <br>
    <br>

    <div class="clearfix"></div>

    @foreach($countries as $country)
        <div class="col-sm-6 col-xs-3 col-lg-push-0">
            <div class="w3-col m1 w3-center" style="align-items: center">
                <div class="right col-xs-3 col-md-12  text-center"
                     style="border: 3px solid #858585; width: 500px; height: 50px">
                    <a href="{{ url('countries/country/'.$country->id) }}" style="color: #413209">
                        <b style="align-items: center; font-size: x-large">{{ $country->name }}</b></a>
                </div>
                <br><br><br>
            </div>
        </div>
    @endforeach

    {{ $countries->links() }}

@stop