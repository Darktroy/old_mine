@extends('layouts.site.inner_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('page_content')
    <!-- Contextual classes -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> Find Offers </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <label for="" class="col-md-1"> Filter By : </label>

                {!! Form::open(['url'=>url('/offers/filter'),'id'=>'filter_form']) !!}

                <div class="col-xs-12 col-md-3">
                    <select data-placeholder="Filter By" data-countries="{{ url('list-countries') }}"
                            data-offer_type="{{ url('list-offer_types') }}"
                            data-sectors="{{ url('offers/sectors') }}"
                            class="select select_type select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true">
                        <option value="0">Choose Type</option>
                        <option value="a">Offer Type</option>
                        <option value="t">Target Country</option>
                        <option value="s">Sector</option>
                        <option value="d">Deadline</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <div class="type-input col-md-4">

                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Offer Type</th>
                    @if(Auth::check() && Auth::user()->type != 3)
                        <th>Offer Owner</th>
                    @endif
                    <th>Deadline</th>
                </tr>
                </thead>
                <tbody>
                @foreach($offers as $k =>  $offer )
                    <?php
                    $class = '';
                    if ($k % 2 == 0) {
                        $class = 'success';
                    } else {
                        $class = 'primary';
                    }
                    ?>
                    <tr class="{{ $class }}">
                        <td> {{ $k +1 }} </td>
                        <td><a href="{{ url('offers/view/'.$offer->id) }}"> {{ $offer->title }} </a></td>
                        <td> {{ $offer->offerType->name }} </td>
                        @if(Auth::check() && Auth::user()->type != 3)
                            <td> {{ $offer->owner->name }} </td>
                        @endif
                        <td> {{ date('Y-m-d',strtotime($offer->deadline)) }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $offers->links() }}
    <!-- /contextual classes -->
@stop
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2({
                tags: true
            });
            $('.agree').on('click', function (e) {
                e.preventDefault();
            })
            $('input.timepicker').timepicker({});

            $('.select_type').on('change', function () {
                var value = $(this).val();
                $('.type-input').empty();

//                Activity
                if (value == 'a') {
                    $('.type-input').append(`<select name="activity_id" class="activity"> <option> offer Type </option>  </select>`);
                    $.ajax({
                        url: $('.select_type').data('offer_type'),
                        type: 'GET',
                        success: function (response) {
                            $.each(response.types, function (k, v) {
                                $('body select.activity').append(`<option value="${v.id}"> ${v.name} </option>`);
                            });
                        }
                    })
                }

//                Deadline
                else if (value == 'd') {
                    $('.type-input').append(`<label for="" class="col-md-2"> From: </label> <div class="col-md-8"> <input type="date" name="deadline" class="form-control"> </div>`);
                    $('.type-input').after(`<div class="col-md-4"> <input type="submit" class="btn btn-primary"> </div>`)
                }
//                Countries
                else if (value == 't') {
                    $('.type-input').append(`<select name="countries" class="countries_list"> <option> Select Country </option> </select>`);
                    $.ajax({
                        url: $('.select_type').data('countries'),
                        type: 'GET',
                        success: function (response) {
                            $.each(response, function (k, v) {
                                $('body select.countries_list').append(`<option value="${v.id}"> ${v.name} </option>`);
                            });
                        }
                    })
//                    Sectors
                } else if (value == 's') {
                    $('.type-input').append(`<select name="sectors" class="sectors_list"> <option> Select Sector </option> </select>`);
                    $.ajax({
                        url: $('.select_type').data('sectors'),
                        type: 'GET',
                        success: function (response) {
//                            console.log(response);
                            $.each(response.sectors, function (k, v) {
//                                console.log(v);
                                $('body select.sectors_list').append(`<option value="${k}"> ${v} </option>`);
                            });
                        }
                    })
                }
            })


            $('body .type-input').on('change', '.activity', function () {
                $('#filter_form').submit();
            });

            $('body .type-input').on('change', '.countries_list', function () {
                $('#filter_form').submit();
            });

            $('body .type-input').on('change', '.sectors_list', function () {
                $('#filter_form').submit();
            });

        });
    </script>
@stop