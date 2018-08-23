@extends('layouts.site.organization')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
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

    @if(isset($position) && $position ==2 )
        <?php $filterBy = $country_id . '/' . $position; ?>
    @else
        <?php $filterBy = auth()->user()->id . '/' . $position; ?>
    @endif
    <!-- Details -->
    <div class="panel panel-flat">
        <div class="panel-body">
            {{--<div class="media stack-media-on-mobile text-left content-group-lg" style="float:right">--}}
            {{--<div class="media-right media-middle text-nowrap">--}}
            {{--<a href="{{url('country/organization/index/'.$filterBy)}}" class="btn bg-blue"><i--}}
            {{--class="position-left"></i> All National Organization</a>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="thumb content-group">
                <img src="{{ ( isset($organization->organizationDetails->logo) && !empty($organization->organizationDetails->logo)) ? asset('media/files/'.$organization->organizationDetails->logo) : '' }}"
                     alt="" class="img-responsive" style="width: 200px; height: 300px">
            </div>
            @if(auth()->user()->id != $user->id)
                <div class="thumb content-group">
                    @if(isset($follow) && $follow == 1)
                        <li><a href="{{ url('country/organization/follow/'.$organization->id) }}" class="followlink"><b
                                        class="btn btn-default follow"> Followed </b></a></li>
                    @else
                        <li><a href="{{ url('country/organization/follow/'.$organization->id) }}" class="followlink"><b
                                        class="btn btn-default follow"> Follow </b></a></li>
                    @endif
                </div>
            @endif

            <div class="media stack-media-on-mobile text-left content-group-lg">
                <div class="media-body">
                    <h5 class="media-heading text-semibold"> {{ $organization->org_name }} </h5>
                    <ul class="list-inline list-inline-separate text-muted no-margin">
                        <li>  {{ $organization->dep_name }} </li>
                        <li>{{ Euromed::time_elapsed_string($organization->created_at) }}</li>
                    </ul>
                </div>
            </div>

            <div class="content-group-lg">
                <ul class="list">
                    <li>
                        <strong class="display-block">About Us :</strong>
                        {!! $organization->organizationDetails->about_us  !!}
                    </li>
                    <li>
                        <strong class="display-block">Services Description :</strong>
                        {!! $organization->organizationDetails->services_desc !!}
                    </li>
                    <li>
                        <strong class="display-block">Website :</strong>
                        {!! $organization->website !!}
                    </li>
                    <li>
                        <strong class="display-block">Number of Employees :</strong>
                        {!! $organization->organizationDetails->no_of_emp !!}
                    </li>
                    <li>
                        <strong class="display-block">Number of Members :</strong>
                        {!! $organization->organizationDetails->no_of_mem !!}
                    </li>
                </ul>
                <br>
            </div>
            <div class="content-group-lg">
                <ul class="list">
                    <li>
                        <a href="{{ url('country/contact_us/'.$filterBy) }}" class="btn btn-primary btn-sm"> Contact Us
                        </a>
                    </li>
                </ul>
            </div>
            <div class="content-group-lg">
                <ul class="list-inline">
                    <li class="list-inline-item">Organization social Pages:</li>
                    <li class="list-inline-item"><a
                                href="{{$organization->facebook_link}}"
                                class="social-button " id=""><span class="fa fa-facebook-official"></span></a>
                    </li>
                    <li class="list-inline-item"><a
                                href="{{$organization->twitter_link}}"
                                class="social-button " id=""><span class="fa fa-twitter"></span></a></li>

                    <li class="list-inline-item"><a
                                href="{{$organization->linkedin_link}}"
                                class="social-button " id=""><span class="fa fa-linkedin"></span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-body">
            <h6><b> Contact Persons </b></h6>
            <br>

            @foreach($organization->organizationContactPerson as $contact)
                <div class="block">
                    <ul></ul>
                    <ul class="block">
                        <li class="display-block" style="margin-left: 20px;">
                            <strong for="first_name">Name: </strong>
                            {!! $contact->first_name !!}  {!! $contact->last_name !!}
                        </li>
                        <li class="display-block" style="margin-left: 20px;">
                            <strong for="position"> Position: </strong>
                            {!! $contact->position !!}
                        </li>
                        <li class="display-block" style="margin-left: 20px;">
                            <strong for="dep_name"> Department: </strong>
                            {!! $contact->department !!}
                        </li>

                        <li class="display-block" style="margin-left: 20px;">
                            <strong for="email"> Email: </strong>
                            {!! $contact->email !!}
                        </li>

                        <li class="display-block" style="margin-left: 20px;">
                            <strong for="email"> Phone: </strong>
                            {!! $contact->mobile !!}
                        </li>
                    </ul>
                </div>
                <br>
            @endforeach
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('.followlink').on('click', function (e) {
                $('.follow').attr(function (e) {
                    $this.replace($this.val(e), 'Followed');
                });
            });
        });

    </script>
@stop