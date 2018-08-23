@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_cities">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">ID</th>
                <th class="column-title">Name</th>
                <th class="column-title">Country</th>
                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($cities as $k => $city)
            <?php $url = url('panel/about_us/city/'.$city->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                @endif
                        <td class=""> {{ $k+1 }} </td>
                        <td class="">{{ $city->name }}</td>
                        @if(count($city->country) >= 1 && !empty($city->country))
                            <td class=" ">{{ $city->country->name }}</td>
                        @else
                            <td class=" ">--</td>
                        @endif
                        <td class=" last">
                            <a href="{{ url('panel/cities/edit/'.$city->id) }}">Edit</a>
                            /
                           <form action="{{ url('panel/cities/delete/'.$city->id) }}"  method="post" onSubmit="return confirm('are you sure you want to delete this city')" style="display:inline;">
                            {{ csrf_field() }}
                                <button class="delete_button"> delete </button>
                            </form>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
            {{ $cities->links() }}
    </div>
@stop