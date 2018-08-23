@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="contact_us_posts">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">ID</th>
                <th class="column-title">title</th>
                <th class="column-title">Offer Type</th>
                <th class="column-title">Offer Owner</th>
                <th class="column-title"> date </th>
                <th class="column-title">dead line</th>
                <th class="column-title no-link last col-xs-1">
                    <span class="nobr">Action</span>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($offers as $k => $offer)
                <?php $url = url('panel/about_us/post/' . $offer->id) ?>
                @if($k%2 == 0)
                    <tr class="even pointer">
                @else
                    <tr class="odd pointer">
                        @endif
                        <td class=" "> {{ $k+1 }} </td>
                        <td class=" ">{{ $offer->title }}</td>
                        <td class=" ">{{ $offer->offerType->name }}</td>
                        <td class=" ">{{ $offer->owner->name }}</td>
                        @if(!empty($offer->offerCountries) && count($offer->offerCountries) >= 1)
                            <td class=" ">
                                @foreach($offer->offerCountries as $country)
                                    {{ $country->name }},
                                @endforeach
                            </td>
                        @else
                            <td class=" ">all</td>
                        @endif
                        <td class=" ">{{ date('Y-m-d',strtotime($offer->deadline))  }}</td>
                        <td class=" last">
                            <a href="{{ url('panel/offers/'.$offer->id.'/edit') }}">Edit</a>
                            /
                            <a href="{{ url('panel/offers/'.$offer->id.'/view') }}">View</a>
                            /
                            <form action="{{ url('panel/offers/'.$offer->id.'/delete') }}" method="POST"
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
        {!! $offers->links() !!}
    </div>
@stop