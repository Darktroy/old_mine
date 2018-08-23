@extends('layouts.site.inner_pages_layout')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
@stop
@section('page_content')
    <!-- Contextual classes -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> Find Calls </h5>
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

                {!! Form::open(['url'=>url('/calls/filter'),'id'=>'filter_form']) !!}

                <div class="col-xs-12 col-md-3">
                    <select data-placeholder="Filter By" data-countries="{{ url('list-countries') }}"
                            class="select select_type select2-hidden-accessible" tabindex="-1"
                            aria-hidden="true">
                        <option value="0">Choose Type</option>
                        <option value="l">Looking for</option>
                        <option value="d">Start Date</option>
                        <option value="t">Target Country</option>
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
                    <th>Caller</th>
                    <th>Looking For</th>
                    <th>Work Place</th>
                    <th>Target Country</th>
                    <th>Start Date</th>
                    <th>Dead Line</th>
                </tr>
                </thead>
                <tbody>
                @foreach($calls as $k =>  $call )
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
                        <td><a href="{{ url('/calls/view/'.$call->id) }}"> {{ $call->title }} </a></td>
                        <td> {{ $call->caller->name }} </td>
                        <td> {{ $for[$call->for] }} </td>
                        <td> {{ $place[$call->workplace] }} </td>
                        @if(isset($call->callCountries) && !empty($call->callCountries) && count($call->callCountries) >= 1)
                            <td> @foreach($call->callCountries as $country)  {{ $country->name }}, @endforeach </td>
                        @elseif(isset($call->country_name) && !empty($call->country_name))
                            <td> {{ $call->country_name }} </td>
                        @else
                            <td> --</td>
                        @endif
                        <td> {{ date('Y-m-d',strtotime($call->selection)) }} </td>
                        <td> {{ date('Y-m-d',strtotime($call->deadline)) }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $calls->links() }}
    <!-- /contextual classes -->
@stop
@section('scripts')
    {{--  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>  --}}
    <script type="text/javascript">
        $(document).ready(function () {
            /*$('select').select2({
                tags: true
            });*/
            $('.agree').on('click', function (e) {
                e.preventDefault();
            })
            //$('input.timepicker').timepicker({});

            $('.select_type').on('change', function () {
                var value = $(this).val();
                $('.type-input').empty();

                if (value == 'l') {
                    $('.type-input').append(`<select name="looking_for" class="looking_for">
                        <option>Choose One</option>
                        <option value="v">Volunteers</option>
                        <option value="i">Interns</option>
                        <option value="e">Employees</option>
                        </select>`);
                } else if (value == 'd') {
                    $('.type-input').append(`<label for="" class="col-md-2"> From: </label> <div class="col-md-8"> <input type="date" name="from" class="form-control"> </div>`);
                    $('.type-input').after(`<div class="to col-md-4"> <label for="" class="col-md-2"> To: </label> <div class="col-md-8"> <input type="date" name="to" class="form-control"> </div> </div> <div class="col-md-4"> <input type="submit" class="btn btn-primary"> </div>`)
                } else if (value == 't') {
                    $('.type-input').append(`<select name="countries" class="countries_list"> <option> Select Country </option> </select>`);
                    $.ajax({
                        url: $('.select_type').data('countries'),
                        type: 'GET',
                        success: function (response) {
                            $.each(response, function (k, v) {
//                                console.log(v.name);
                                $('body select.countries_list').append(`<option value="${v.id}"> ${v.name} </option>`);
                            });
                        }
                    })
                }
            })

            $('body .type-input').on('change', '.looking_for', function () {
                $('#filter_form').submit();
            });

            $('body .type-input').on('change', '.countries_list', function () {
                $('#filter_form').submit();
            });

        });
    </script>
@stop