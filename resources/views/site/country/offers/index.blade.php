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

    @if(isset($position) && $position ==2 )
        <?php $filterBy = $country_id . '/' . $position; ?>
    @else
        <?php $filterBy = auth()->user()->id . '/' . $position; ?>
    @endif
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">List All offers</h6>
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
                <th>Offer Type</th>
                <th>Creator</th>
                <th> Targets</th>
                <th>Deadline</th>
                {{--<th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>--}}
            </tr>
            </thead>
            <tbody>
            @if(isset($offers))
                @foreach($offers as $offer)
                    <tr class="offer_{{ $offer->id }}">
                        <td><a href="{{ url('/offers/view/'.$offer->id.'/'.$filterBy) }}"> {{ $offer->title }} </a></td>
                        <td class=" ">{{ $offer->offerType->name }}</td>
                        <td class=" ">{{ $offer->owner->name }}</td>
                        @if(!empty($offer->offerCountries) && count($offer->offerCountries) >= 1)
                            <td class=" ">
                                @foreach($offer->offerCountries as $countryOffer)
                                    <span class="label label-info">
                                    {{ $countryOffer->name }}
                                </span>
                                @endforeach
                            </td>
                        @else
                            <td class=" ">all</td>
                        @endif
                        <td class=" ">{{ date('Y-m-d',strtotime($offer->deadline))  }}</td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    @if(!empty(auth()->user()))
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('country/offers/'.$offer->id.'/edit/'.$filterBy) }}"><i
                                                            class=" icon-pen"></i> Edit </a></li>
                                            <li><a href="#" data-token="{{ csrf_token() }}"
                                                   data-url="{{ url('country/offers/'.$offer->id.'/delete') }}"
                                                   class="delete_offer"><i class="icon-x"></i> Delete </a></li>
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{--{{ $offers->links() }}--}}
    <!-- /profile info -->

@stop

@section('scripts')
    <script>
        $('a.delete_offer').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var token = $(this).data('token');
            var form = new Form();
            if (confirm('Are You Sure You Want To Delete This offer')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'_token': token},
                    success: function (response) {
                        $('.offer_' + response.id).slideUp(600);
                        var text = `<div class="activity-item">
                        <i class="fa fa-flag-checkered" aria-hidden="true"></i>
                        <div class="activity" style="display:inline; margin-left:15px;"> ${response.message} </div> </div>
                        `;
                        form.errors.notification('information', text);
                    }
                });
            }
        });
    </script>
@stop


