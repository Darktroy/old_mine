@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="col-md-9 col-sm-9 col-xs-12">

        <ul class="stats-overview">
            <li>
                <span class="name"> Required Numbers </span>
                <span class="value text-success"> {{ $call->number }} </span>
            </li>
            <li>
                <span class="name"> Start Date </span>
                <span class="value text-success"> {{ date('Y-m-d',strtotime($call->from)) }} </span>
            </li>
            <li class="hidden-phone">
                <span class="name"> End Date </span>
                <span class="value text-success"> {{ date('Y-m-d',strtotime($call->to)) }} </span>
            </li>
        </ul>
        <br/>

        <!-- end of user messages -->
        <ul class="messages">
            <li>
                <div class="message_wrapper">
                    <h4 class="heading"> Call For </h4>
                    <blockquote class="message"> {{ $looking_for[$call->for] }} </blockquote>
                    <br/>
                </div>
            </li>
            <li>

                <div class="message_wrapper">
                    <h4 class="heading">Contact Person</h4>
                    <blockquote class="message"> {{ $call->person }} </blockquote>
                    <br/>
                </div>
            </li>
            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Email</h4>
                    <blockquote class="message"> {{ $call->email }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Task Details</h4>
                    <blockquote class="message"> {{ $call->task_details }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Required Special Skills:@if($call->special_skills == 1) Yes @else
                            no @endif </h4>
                    @if($call->special_skills == 1)
                        <blockquote class="message"> {{ $call->skills_details }} </blockquote>
                    @else
                        <blockquote class="message"> --</blockquote>
                    @endif
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Call DeadLine</h4>
                    <blockquote class="message"> {{ date('Y-m-d',strtotime($call->deadline)) }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Date Of Selection</h4>
                    <blockquote class="message"> {{ date('Y-m-d',strtotime($call->selection)) }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Gender</h4>
                    <blockquote class="message"> {{ $genders[$call->gender] }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Voluntary work place</h4>
                    <blockquote class="message"> {{ $place[$call->workplace] }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">Benefits</h4>
                    <blockquote class="message"> {{ $call->benefits }} </blockquote>
                    <br/>
                </div>
            </li>

            <li>
                <div class="message_wrapper">
                    <h4 class="heading">More Information</h4>
                    <blockquote class="message"> {{ $call->more }} </blockquote>
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
                <h2>Call Details</h2>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <h3 class="green"><i class="fa fa-paint-brush"></i> {{ $call->title }} </h3>

                <p> {{ $call->task_details }} </p>
                <br/>

                <div class="project_detail">

                    <p class="title"> Caller </p>
                    <p>{{ $call->caller->name }}</p>
                    <p class="title">Project Leader</p>
                    <p>Tony Chicken</p>
                </div>

                <hr/>

                <div class="text-center mtop20" id="call_actions">
                    @if($call->status === 0)
                        <a href="#" class="btn btn-sm btn-primary" @click="
                        approveCall('{{ url('panel/calls/'.$call->id.'/status/1') }}')">Approve</a>
                    @elseif($call->status === 1)
                        <a href="#" class="btn btn-sm btn-danger" @click="
                        rejectCall('{{ url('panel/calls/'.$call->id.'/status/0') }}')">Reject</a>
                    @else
                        <a href="#" class="btn btn-sm btn-primary" @click="
                         approveCall('{{ url('panel/calls/'.$call->id.'/status/1') }}')">Approve</a>

                        <a href="#" class="btn btn-sm btn-danger" @click="
                        rejectCall('{{ url('panel/calls/'.$call->id.'/status/0') }}')">Reject</a>
                    @endif

                    @if($call->activate == 0)
                        <a href="#" class="btn btn-sm btn-info" @click="
                        activateCall('{{ url('panel/calls/'.$call->id.'/activation/1') }}')">Activate</a>
                    @else
                        <a href="#" class="btn btn-sm btn-warning" @click="
                        deactivateCall('{{ url('panel/calls/'.$call->id.'/activation/0') }}')">Deactivate</a>
                    @endif
                </div>
            </div>

        </section>

    </div>
    <!-- end project-detail sidebar -->
@stop
@section('scripts')
    <script src="{{ asset('panel-assets/js/calls.js') }}"></script>
@stop