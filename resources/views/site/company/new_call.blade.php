@extends('layouts.site.company')
@section('profile_pages')
    <!-- Profile info -->

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span>
            </button>
            There is some Errors Please Fix it
        </div>
    @endif

    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">×</span>
            </button>
            {{ session('message') }}
        </div>
    @endif


    <div class="panel panel-flat " id="calls">
        <div class="panel-heading">
            <h6 class="panel-title">Company New Call</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            @include('common.calls_form')
        </div>

    </div>
    <!-- /profile info -->

@stop

@section('scripts')
    <script>
        // $('.datepicker').datepicker({
        //     calendarWeeks: true,
        //     autoclose: true,
        //     todayHighlight: true,
        //     toggleActive: true,
        //     todayBtn: true,
        //     format: 'yyyy-mm-dd'
        // });

        /*$('select').select2({
            tags: true
        });*/

        $('#call_country').on('change', function () {
            var countries_id = $(this).val();
            var url = $(this).data('url');
            var token = $(this).data('token');
            $.ajax({
                url: url,
                data: {'countries_id': countries_id, '_token': token},
                type: 'GET',
                success: function (response) {
//                    console.log(response);
                    $('.call_city').empty();
                    $.each(response.cities, function (k, v) {
                        $('.call_city').append(`<option value="${k}"> ${v} </option>`)
//                        console.log(k,v);
                    })
                }
            })
        })
    </script>
    {{--  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>  --}}
@stop