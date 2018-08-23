@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_posts">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">ID</th>
                <th class="column-title">title</th>
                <th class="column-title">Caller</th>
                <th class="column-title">Looking For</th>
                <th class="column-title">Work Place</th>
                <th class="column-title">Target Country</th>
                <th class="column-title">Start date</th>
                <th class="column-title">End Date</th>
                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($calls as $k => $call)
                <?php $url = url('panel/about_us/post/' . $call->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                        @endif
                        <td class=" "> {{ $k+1 }} </td>
                        <td class=" ">{{ $call->title }}</td>
                        <td class=" ">{{ $call->caller->name }}</td>
                        <td class=" ">{{ $looking_for[$call->for]}}</td>
                        <td class=" ">{{ $place[$call->workplace]}}</td>
                        @if(!empty($call->callCountries) && count($call->callCountries) >= 1)
                            <td class=" ">
                                @foreach($call->callCountries as $country)
                                    {{ $country->name }},
                                @endforeach
                            </td>
                        @else
                            <td class=" ">all</td>
                        @endif
                        <td class=" ">{{ date('Y-m-d',strtotime($call->from))  }}</td>
                        <td class=" ">{{ date('Y-m-d',strtotime($call->to))  }}</td>
                        <td class=" last">
                            <a href="{{ url('panel/calls/'.$call->id.'/edit') }}">Edit</a>
                            /
                            <a href="{{ url('panel/calls/'.$call->id.'/view') }}">View</a>
                            /
                            <form action="{{ url('panel/calls/'.$call->id.'/delete') }}" method="POST"
                                  onSubmit="return confirm('are you sure you want to delete this Call')"
                                  style="display:inline;">
                                {{ csrf_field() }}
                                <button class="delete_button"> delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $calls->links() !!}
    </div>
@stop