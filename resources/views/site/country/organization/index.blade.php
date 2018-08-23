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
            <h6 class="panel-title">List All Organizations</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>
        <hr>
        <div class="panel-body">
            <div class="row">
                @if(isset($position) && $position ==2 )
                    <?php $filterBy = $country_id . '/' . $position; ?>
                @else
                    <?php $filterBy = auth()->user()->id . '/' . $position; ?>
                @endif
                @if(isset($organizations) && count($organizations) >= 1)
                    @foreach($organizations as $organization)
                        <div class="col-md-4 topic_{{ $organization->id }}">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="thumb content-group">
                                        <?php $details = \App\Models\OrganizationDescription::where('organization', $organization->id)->first(); ?>
                                        <img src="{{ ( isset($details->logo) && !empty($details->logo)) ? asset('media/files/'.$details->logo) : '' }}"
                                             alt="" class="img-responsive">
                                    </div>

                                    <h5 class="text-semibold mb-5">
                                        <a href="{{ url('country/organization/view/'.$organization->id.'/'.$filterBy) }}"
                                           class="text-default">{{ $organization->org_name}}</a>
                                    </h5>

                                    <h5 class="text-semibold mb-5">
                                        <a href="{{ url('country/organization/view/'.$organization->id.'/'.$filterBy) }}"
                                           class="btn btn-primary btn-small">View profile</a>
                                    </h5>
                                    <h4 class="text-semibold mb-5">
                                        <a href="#" class="text-default">{{ $organization->dep_name}}</a>
                                    </h4>
                                    <h5 class="text-semibold mb-5">
                                        <a href="#" class="text-default">{{ $organization->website}}</a>
                                    </h5>

                                    <ul class="list-inline list-inline-separate text-muted content-group">
                                        <li> {{ date('F d\t\h, Y',strtotime($organization->created_at)) }}</li>
                                    </ul>

                                    {!! $details->about_us !!}
                                </div>

                                <div class="panel-footer panel-footer-condensed">
                                    <div class="heading-elements not-collapsible">
                                        <ul class="list-inline list-inline-separate heading-text text-muted">
                                            {{--<li><a href="#" class="text-muted"><i--}}
                                            {{--class="icon-heart6 text-size-base text-pink position-left"></i>--}}
                                            {{--29</a></li>--}}
                                        </ul>
                                        @if(!empty(auth()->user()))
                                            <a href="{{ url('country/organization/'.$organization->id.'/edit'.'/'.$filterBy) }}"
                                               class="heading-text pull-left">
                                                <i class="icon-arrow-left13 position-right"></i> Edit </a>

                                            {{--<a href="{{ url('country/contact_us/'.$filterBy) }}"--}}
                                            {{--class="heading-text contact-us-content">--}}
                                            {{--<i class="icon-flip-vertical2 position-center-center"></i> Contact Us--}}
                                            {{--</a>--}}

                                            <a href="#"
                                               data-url="{{ url('country/organization/'.$organization->id.'/delete') }}"
                                               data-token="{{ csrf_token() }}"
                                               class="heading-text delete_topic pull-right">
                                                <i class=" icon-x position-right"></i> Delete </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2 class="text-center"> No Organizations Yet </h2>
                @endif
            </div>
        </div>
    </div>
    <!-- /profile info -->

@stop

@section('scripts')
    <script>
        $('a.delete_topic').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var token = $(this).data('token');
            var form = new Form();
            if (confirm('Are You Sure You Want To Delete This News')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'_token': token},
                    success: function (response) {
                        $('.topic_' + response.id).slideUp(600);
                        var text = `<div class="activity-item">
                        <i class="fa fa-flag-checkered" aria-hidden="true"></i>
                        <div class="activity" style="display:inline; margin-left:15px;"> ${response.success} </div> </div>
                        `;
                        form.errors.notification('information', text);
                    }
                });
            }
        });
    </script>
@stop


