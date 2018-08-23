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
            <h6 class="panel-title">List All Calls</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>

        <table class="table table-togglable table-hover">
            <thead>
            <tr>
                <th>Title</th>
                <th>Caller</th>
                <th>Looking For</th>
                <th>Work Place</th>
                <th>Targeted Country</th>
                <th>Start Date</th>
                <th>Deadline</th>
                {{--<th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>--}}
            </tr>
            </thead>
            <tbody>
            @if(!empty(auth()->user()))
                <?php $filterBy = $country_id . '/' . $position; ?>
            @else
                @if(isset($position) && $position ==2 )
                    <?php $filterBy = $country_id . '/' . $position; ?>
                @else
                    <?php $filterBy = auth()->user()->id . '/' . $position; ?>
                @endif
            @endif
            @if(! empty($calls))
                @foreach($calls as $call)
                    <tr class="call_{{ $call->id }}">
                        <td><a href="{{ url('/calls/view/'.$call->id) }}"> {{ $call->title }} </a></td>
                        <td> {{ $call->caller->name }} </td>
                        <td> {{ $looking_for[$call->for] }} </td>
                        <td> {{ $place[$call->workplace] }} </td>
                        @if(isset($call->callCountries) && !empty($call->callCountries) && count($call->callCountries) >= 1)
                            <td>
                                @foreach($call->callCountries as $countryCall)
                                    <span class="label label-info" style="margin-bottom: 5px;">
                                    {{ $countryCall->name }}
                                </span>
                                @endforeach
                            </td>
                        @elseif(isset($call->country_name) && !empty($call->country_name))
                            <td> {{ $call->country_name }} </td>
                        @else
                            <td> --</td>
                        @endif
                        <td> {{ date('Y-m-d',strtotime($call->selection)) }} </td>
                        <td> {{ date('Y-m-d',strtotime($call->deadline)) }} </td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ url('country/calls/'.$call->id.'/edit/'.$filterBy) }}"><i
                                                        class=" icon-pen"></i> Edit </a></li>
                                        <li><a href="#" data-token="{{ csrf_token() }}"
                                               data-url="{{ url('country/calls/'.$call->id.'/delete') }}"
                                               class="delete_call"><i class="icon-x"></i> Delete </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    @if(isset($calls))
        {{ $calls->links() }}
    @endif
    <!-- /profile info -->

@stop

@section('scripts')
    <script>
        $('a.delete_call').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var token = $(this).data('token');
            var form = new Form();
            if (confirm('Are You Sure You Want To Delete This call')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'_token': token},
                    success: function (response) {
                        $('.call_' + response.id).slideUp(600);
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


