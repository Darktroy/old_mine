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
            <h6 class="panel-title">List All Events</h6>
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
                <th data-toggle="true">Title</th>
                <th data-hide="phone">Main Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                {{--<th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>--}}
            </tr>
            </thead>
            <tbody>

            @if(isset($position) && $position ==2 )
                <?php $filterBy = $country_id . '/' . $position; ?>
            @else
                <?php $filterBy = auth()->user()->id . '/' . $position; ?>
            @endif
            @foreach($events as $event)
                <tr class="agreement_{{ $event->id }}">
                    <td><a href="" onclick="return false;">{{ $event->title }}</a></td>
                    <td> {{ $event->min_description }} </td>
                    <td> {{ date('Y-m-d',strtotime($event->start_date)) }} </td>
                    <td> {{ date('Y-m-d',strtotime($event->end_date)) }} </td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon-menu9"></i>
                                </a>

                                @if(!empty(auth()->user()))
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ url('country/events/'.$event->id.'/edit/'.$filterBy) }}"><i
                                                    class=" icon-pen"></i> Edit </a></li>
                                    <li><a href="#" data-token="{{ csrf_token() }}"
                                           data-url="{{ url('country/events/'.$event->id.'/delete') }}"
                                           class="delete_event"><i class="icon-x"></i> Delete </a></li>
                                </ul>
                                @endif
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /profile info -->

@stop

@section('scripts')
    <script>
        $('a.delete_event').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var token = $(this).data('token');
            var form = new Form();
            if (confirm('Are You Sure You Want To Delete This Event')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'_token': token},
                    success: function (response) {
                        $('.agreement_' + response.id).slideUp(600);
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


