@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="col-md-9 col-sm-9 col-xs-12">

        <ul class="stats-overview">
            <li>
                <span class="name"> Owner </span>
                <span class="value text-success"> {{ $offer->owner->name}} </span>
            </li>
            <li>
                <span class="name"> Eamil </span>
                <span class="value text-success"> {{ $offer->email }} </span>
            </li>
            <li class="hidden-phone">
                <span class="name"> Deadline </span>
                <span class="value text-success"> {{ date('Y-m-d',strtotime($offer->deadline)) }} </span>
            </li>
        </ul>
        <br/>

        <!-- end of user messages -->
        <ul class="messages">
            <li>
                <div class="message_wrapper">
                    <h4 class="heading"> Title </h4>
                    <blockquote class="message"> {{ $offer->title }} </blockquote>
                    <br/>
                </div>
            </li>
            <li>

                <div class="message_wrapper">
                    <h4 class="heading">Contact Person</h4>
                    <blockquote class="message"> {{ $offer->contact_person }} </blockquote>
                    <br/>
                </div>
            </li>
            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Phone</h4>
                    <blockquote class="message"> {{ $offer->phone }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Offer Type</h4>
                    <blockquote class="message"> {{ $offer->offerType->name }} </blockquote>
                    <br/>
                </div>
            </li>


            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Offer DeadLine</h4>
                    <blockquote class="message"> {{ date('Y-m-d',strtotime($offer->deadline)) }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Offer Sectors</h4>
                    <blockquote class="message"> @foreach($offer->offerSectors as $sector) {{ $sectors[$sector->sector_id] }} ,  @endforeach </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Description</h4>
                    <blockquote class="message"> {{ $offer->description }} </blockquote>
                    <br/>
                </div>
            </li>

        </ul>
        <!-- end of user messages -->

    </div>

    <!-- start project-detail sidebar -->
    <div class="col-md-3 col-sm-3 col-xs-12">

        <section class="panel">

            <div class="x_title">
                <h2>Offer Details</h2>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <h3 class="green"><i class="fa fa-paint-brush"></i> {{ $offer->title }} </h3>

                <p> {{ $offer->summary }} </p>
                <br/>

                <div class="project_detail">

                    <p class="title"> Owner </p>
                    <p>{{ $offer->owner->name }}</p>

                </div>

                <hr/>

                <div class="text-center mtop20" id="offer_actions">
                    @if($offer->status === 0)
                        <a href="#" class="btn btn-sm btn-primary" @click="
                        approveOffer('{{ url('panel/offers/'.$offer->id.'/status/1') }}')">Approve</a>
                    @elseif($offer->status === 1)
                        <a href="#" class="btn btn-sm btn-danger" @click="
                        rejectOffer('{{ url('panel/offers/'.$offer->id.'/status/0') }}')">Reject</a>
                    @else
                        <a href="#" class="btn btn-sm btn-primary" @click="
                         approveOffer('{{ url('panel/offers/'.$offer->id.'/status/1') }}')">Approve</a>

                        <a href="#" class="btn btn-sm btn-danger" @click="
                        rejectOffer('{{ url('panel/offers/'.$offer->id.'/status/0') }}')">Reject</a>
                    @endif

                    @if($offer->active == 0)
                        <a href="#" class="btn btn-sm btn-info" @click="
                        activateOffer('{{ url('panel/offers/'.$offer->id.'/activation/1') }}')">Activate</a>
                    @else
                        <a href="#" class="btn btn-sm btn-warning" @click="
                        deactivateOffer('{{ url('panel/offers/'.$offer->id.'/activation/0') }}')">Deactivate</a>
                    @endif
                </div>
            </div>

        </section>

    </div>
    <!-- end project-detail sidebar -->
@stop
@section('scripts')
    <script src="{{ asset('panel/js/offers.js') }}"></script>
@stop