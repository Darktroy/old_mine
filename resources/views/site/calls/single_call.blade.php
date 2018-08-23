@extends('layouts.site.inner_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('page_content')
    <!-- Details -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="media stack-media-on-mobile text-left content-group-lg">
                <div class="media-body">
                    <h5 class="media-heading text-semibold"> {{ $call->title }} </h5>
                    <ul class="list-inline list-inline-separate text-muted no-margin">
                        <li>@foreach($call->callCities as $city) {{ $city->name }}, @endforeach</li>
                        <li> @foreach($call->callCountries as $countryCall) {{ $countryCall->name }}, @endforeach </li>
                        {{--<li>{{ Euromed::time_elapsed_string($call->created_at) }}</li>--}}
                    </ul>
                </div>

                <div class="media-right media-middle text-nowrap">
                    <a href="#" class="btn bg-blue"><i class="icon-envelop2 position-left"></i> Apply for this Call</a>
                </div>
            </div>


            <div class="content-group-lg">
                <h6 class="text-semibold">Call Details:</h6>
                <br>
                <ul class="list">
                    <li>
                        <strong class="display-block"> Call For: </strong>
                        {{ $for[$call->for] }}
                    </li>
                    <li>
                        <strong class="display-block">Contact Person:</strong>
                        {{ $call->person }}
                    </li>
                    <li>
                        <strong class="display-block">Email :</strong>
                        {{ $call->email }}
                    </li>
                    <li>
                        <strong class="display-block">Task Details: </strong>
                        {!!  $call->task_details  !!}
                    </li>
                    @if(!empty($call->special_skills) && $call->special_skills == 1)
                        <li>
                            <strong class="display-block">Special Skills: (Yes) </strong>
                            {!!  $call->skills_details  !!}
                        </li>
                    @endif
                    <li>
                        <strong class="display-block">Deadline :</strong>
                        {{ date('Y-m-d',strtotime($call->deadline)) }}
                    </li>
                    <li>
                        <strong class="display-block">Selection Date :</strong>
                        {{ date('Y-m-d',strtotime($call->selection)) }}
                    </li>
                    <li>
                        <strong class="display-block">Required Number :</strong>
                        {{ $call->number }}
                    </li>
                    <li>
                        <strong class="display-block">Working Hours :</strong>
                        {{ $call->working_hours }}
                    </li>
                    <li>
                        <strong class="display-block">Gender :</strong>
                        {{ $genders[$call->gender] }}
                    </li>
                    <li>
                        <strong class="display-block">From :</strong>
                        {{ $call->from }}
                    </li>
                    <li>
                        <strong class="display-block">To :</strong>
                        {{ $call->to }}
                    </li>
                    <li>
                        <strong class="display-block">Work Place:</strong>
                        {{ $place[$call->workplace] }}
                    </li>
                    <li>
                        <strong class="display-block">Benefits :</strong>
                        {!! $call->benefits  !!}
                    </li>
                    <li>
                        <strong class="display-block">More :</strong>
                        {!! $call->more !!}

                    </li>
                </ul>
            </div>


            <ul class="list-inline no-margin">
                <li class="mt-5">
                    <a href="#" class="btn bg-blue">
                        <i class="icon-envelop2 position-left"></i>
                        Apply for this Call
                    </a>
                </li>
                {{--<li class="mt-5">--}}
                {{--<a href="#" class="btn btn-default">--}}
                {{--<i class="icon-checkmark3 position-left"></i>--}}
                {{--Save this job--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--<li class="mt-5">--}}
                {{--<a href="#" class="btn btn-default">--}}
                {{--<i class="icon-share4 position-left"></i>--}}
                {{--Share--}}
                {{--</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
    <!-- /details -->
    {{--
        @if(Auth::check())
            <!-- Company profile -->
            <h5 class="pt-10 content-group">Company profile</h5>
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="media stack-media-on-mobile text-left content-group">
                        <a href="#" class="media-left media-middle">
                            <img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">
                        </a>

                        <div class="media-body">
                            <h5 class="media-heading text-semibold">Microsoft</h5>
                            <ul class="list-inline list-inline-separate text-muted no-margin">
                                <li>IT Services</li>
                            </ul>
                        </div>

                        <div class="media-right media-middle text-nowrap">
                            <ul class="list-inline no-margin">
                                <li><a href="#" class="btn bg-blue"><i class="icon-menu7 position-left"></i> All
                                        positions</a>
                                </li>
                                <li><a href="#" class="btn btn-default"><i class="icon-plus2 position-left"></i> Follow</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <p>Across a Global footprint, we believe we’re at our best when you’re at yours. From our diverse
                        workforce,
                        our flexible working policies to our creative work spaces, we embrace a culture of learning and
                        sharing
                        to develop our next stage growth. It’s in our hearts to push forward, to create a better future, to
                        never rest and find new ways that help people communicate.</p>

                    We are committed to developing the very best people by offering a flexible, motivating and inclusive
                    workplace in which talent is truly recognised and rewarded. We respect, value and celebrate our people’s
                    individual differences - we are not only multinational but multicultural too. That’s what we mean when
                    we
                    say Power to you.
                </div>
            </div>
            <!-- /company profile -->
        @endif  --}}

    {{--<!-- Similar jobs -->--}}
    {{--<h5 class="pt-10 content-group">Similar jobs</h5>--}}
    {{--<div class="row">--}}
    {{--<div class="col-sm-6">--}}
    {{--<div class="media panel panel-body stack-media-on-mobile">--}}
    {{--<div class="media-left">--}}
    {{--<a href="#">--}}
    {{--<img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">--}}
    {{--</a>--}}
    {{--</div>--}}

    {{--<div class="media-body">--}}
    {{--<h6 class="media-heading text-semibold">--}}
    {{--<a href="#">Interaction UX/UI Industrial Designer</a>--}}
    {{--</h6>--}}

    {{--<ul class="list-inline list-inline-separate text-muted mb-10">--}}
    {{--<li><a href="#" class="text-muted">Dell</a></li>--}}
    {{--<li>Amsterdam, Netherlands</li>--}}
    {{--</ul>--}}

    {{--Extended kindness trifling remember he confined outlived if. Assistance sentiments yet unpleasing--}}
    {{--say. Open they an busy they my such high. An active dinner wishes at unable hardly no talked on.--}}
    {{--Immediate him her resolving his favourite. Wished denote abroad at branch at. Mind what no by kept.--}}
    {{--</div>--}}

    {{--<div class="media-right text-nowrap">--}}
    {{--<span class="label bg-blue">New</span>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="media panel panel-body stack-media-on-mobile">--}}
    {{--<div class="media-left">--}}
    {{--<a href="#">--}}
    {{--<img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">--}}
    {{--</a>--}}
    {{--</div>--}}

    {{--<div class="media-body">--}}
    {{--<h6 class="media-heading text-semibold">--}}
    {{--<a href="#">Front-End Designer / Developer</a>--}}
    {{--</h6>--}}

    {{--<ul class="list-inline list-inline-separate text-muted mb-10">--}}
    {{--<li><a href="#" class="text-muted">The North Face</a></li>--}}
    {{--<li>The Hague, Netherlands</li>--}}
    {{--</ul>--}}

    {{--Quick six blind smart out burst. Perfectly on furniture dejection determine my depending an to. Add--}}
    {{--short water court fat. Her bachelor honoured perceive securing but desirous ham required. Questions--}}
    {{--deficient acuteness to engrossed as. Entirely led ten humoured greatest and yourself besides--}}
    {{--country.--}}
    {{--</div>--}}

    {{--<div class="media-right text-nowrap">--}}
    {{--<span class="label bg-blue">New</span>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="media panel panel-body stack-media-on-mobile">--}}
    {{--<div class="media-left">--}}
    {{--<a href="#">--}}
    {{--<img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">--}}
    {{--</a>--}}
    {{--</div>--}}

    {{--<div class="media-body">--}}
    {{--<h6 class="media-heading text-semibold">--}}
    {{--<a href="#">Senior UX Designer</a>--}}
    {{--</h6>--}}

    {{--<ul class="list-inline list-inline-separate text-muted mb-10">--}}
    {{--<li><a href="#" class="text-muted">Transfer Wise</a></li>--}}
    {{--<li>Nijmegen, Netherlands</li>--}}
    {{--</ul>--}}

    {{--By an outlived insisted procured improved am. Paid hill fine ten now love even leaf. Supplied--}}
    {{--feelings mr of dissuade recurred no it offering honoured. Am of of in collecting devonshire--}}
    {{--favourable excellence. Her sixteen end ashamed cottage yet reached get hearing invited. Resources--}}
    {{--ourselves.--}}
    {{--</div>--}}

    {{--<div class="media-right text-nowrap">--}}
    {{--<span class="text-muted">5 days ago</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-sm-6">--}}
    {{--<div class="media panel panel-body stack-media-on-mobile">--}}
    {{--<div class="media-left">--}}
    {{--<a href="#">--}}
    {{--<img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">--}}
    {{--</a>--}}
    {{--</div>--}}

    {{--<div class="media-body">--}}
    {{--<h6 class="media-heading text-semibold">--}}
    {{--<a href="#">UX Lead Designer</a>--}}
    {{--</h6>--}}

    {{--<ul class="list-inline list-inline-separate text-muted mb-10">--}}
    {{--<li><a href="#" class="text-muted">IBM</a></li>--}}
    {{--<li>Lelystad, Netherlands</li>--}}
    {{--</ul>--}}

    {{--Contented get distrusts certainty nay are frankness concealed ham. On unaffected resolution on--}}
    {{--considered of. No thought me husband or colonel forming effects. End sitting shewing who saw besides--}}
    {{--son musical adapted. Contrasted interested eat alteration pianoforte sympathize was.--}}
    {{--</div>--}}

    {{--<div class="media-right text-nowrap">--}}
    {{--<span class="text-muted">3 days ago</span>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="media panel panel-body stack-media-on-mobile">--}}
    {{--<div class="media-left">--}}
    {{--<a href="#">--}}
    {{--<img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">--}}
    {{--</a>--}}
    {{--</div>--}}

    {{--<div class="media-body">--}}
    {{--<h6 class="media-heading text-semibold">--}}
    {{--<a href="#">Designer, CRM</a>--}}
    {{--</h6>--}}

    {{--<ul class="list-inline list-inline-separate text-muted mb-10">--}}
    {{--<li><a href="#" class="text-muted">CNN</a></li>--}}
    {{--<li>Rotterdam, Netherlands</li>--}}
    {{--</ul>--}}

    {{--At as in understood an remarkably solicitude. Mean them very seen she she. Use totally written the--}}
    {{--observe pressed justice. Instantly cordially far intention recommend estimable yet her his. Ladies--}}
    {{--stairs enough esteem add fat all enable. Needed its design number winter see. Oh be me sure wise.--}}
    {{--</div>--}}

    {{--<div class="media-right text-nowrap">--}}
    {{--<span class="text-muted">4 days ago</span>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="media panel panel-body stack-media-on-mobile">--}}
    {{--<div class="media-left">--}}
    {{--<a href="#">--}}
    {{--<img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">--}}
    {{--</a>--}}
    {{--</div>--}}

    {{--<div class="media-body">--}}
    {{--<h6 class="media-heading text-semibold">--}}
    {{--<a href="#">FPGA Designer</a>--}}
    {{--</h6>--}}

    {{--<ul class="list-inline list-inline-separate text-muted mb-10">--}}
    {{--<li><a href="#" class="text-muted">ING Bank</a></li>--}}
    {{--<li>Eindhoven, Netherlands</li>--}}
    {{--</ul>--}}

    {{--By so delight of showing neither believe he present. Deal sigh up in shew away when. Pursuit express--}}
    {{--no or prepare replied. Wholly formed old latter future but way she. Day her likewise smallest--}}
    {{--expenses judgment building man carriage gay. Considered introduced themselves mr to discretion at.--}}
    {{--</div>--}}

    {{--<div class="media-right text-nowrap">--}}
    {{--<span class="text-muted">7 days ago</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /similar jobs -->--}}
@stop