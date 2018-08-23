@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_ideas">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th>
                    <input type="checkbox" id="check-all" name="table_records">
                </th>
                <th class="column-title">ID</th>
                <th class="column-title">Organization Name</th>
                <th class="column-title">Department Name</th>
                <th class="column-title">Country Name</th>
                <th class="column-title">City Name</th>

                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($applications as $k => $application)
                <?php $url = url('panel/application/view/' . $application->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                        @endif
                        <td class="a-center ">
                            <input type="checkbox" name="">
                        </td>
                        <td class=" "> {{ $k+1 }} </td>
                        <td class=" ">{{ $application->org_name }}</td>
                        <td class=" ">{{ $application->dep_name }}</td>
                        <td class=" ">{{  \App\Models\Country::where('id',$application->country_id)->value('name') }}</td>
                        <td class=" ">{{  \App\Models\City::where('id',$application->city_id)->value('name') }}</td>
                        <td class=" last">
                            <a href="{{ url('panel/application/view/'.$application->id) }}">View</a>
                            /
                            <form action="{{ url('panel/application/edit/'.$application->id) }}" method="POST"
                                  style="display:inline;">{!! csrf_field() !!}
                                <button class="delete_button"> Accept</button>
                            </form>
                            /
                            <form action="{{ url('panel/application/delete/'.$application->id) }}" method="POST"
                                  onSubmit="return confirm('are you sure you want to delete this Application')"
                                  style="display:inline;">{!! csrf_field()  !!}
                                <button class="delete_button"> delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <modal v-if="modal" @close="modal = false">
            <h4 class="modal-title" slot="title" id="myModalLabel">@{{ title }}</h4>
            <p slot="message_body">@{{ message_body }}</p>
        </modal>
    </div>
@stop