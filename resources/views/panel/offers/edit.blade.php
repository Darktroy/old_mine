@extends('layouts.panel.blank_page')
@section('plank_content')
    <style>

        .skills_details {
            display: none;
        }

        .other_activities {
            display: none;
        }

    </style>
    <div class="row">
        <div id="new_slide_form">
            {!! Form::model($offer,['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left','files'=>true])  !!}
                @include('common.offer_form',['offer_countries'=>$offer->offerCountries->pluck('id')->toArray(),'offerSectors'=>$offer->offerSectors->pluck('id')->toArray()])
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $('.activities').on('change', function () {
            var value = $(this).val();
            if (value == 0) {
                $('.other_activities').empty().append(`<div class="form-group"> <label> activity Name </label> <input type="text" name="other_activity" class="form-control"> </div>`).show();
            }
        })
    </script>
@stop