@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div id="edit_slide_form">
            {!! Form::model($slide,['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal
            form-label-left',
            'files'=>true ])  !!}

            <div class="form-group">
                <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-lg">
                    <i class="fa fa-edit"></i> Show Image
                </a>
                <a class="btn btn-app" @click.prevent="deleteImage('{{ $slide->image }}','{{ $slide->id }}','{{ url('panel/home/slider/'.$slide->id.'/imageDelete')}}')">
                    <i class="fa fa-close"></i> Delete Image
                </a>
            </div>

            <div class="form-group">
                {!! Form::label('profile','image:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="image" @change="imageChanged" class="form-control col-md-7
                    col-xs-12">
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('title','Title:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('title',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('caption','Caption:',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('caption',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('red_button_title','Red Button Title',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="red_button_title" value="" class="form-control col-md-7
                    col-xs-12"
                           v-model="red_button_title"/>
                </div>
            </div>

            <div class="form-group" v-if="red_button_title">
                {!! Form::label('red_button_url','Red Button Url',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::url('red_button_url',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('transparent_button_title','Transparent Button Title',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="transparent_button_title" value=""
                           v-model="transparent_button_title"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group" v-if="transparent_button_title">
                {!! Form::label('transparent_button_url','Transparent Button Url',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::url('transparent_button_url',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="checkbox">
                <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                <label>
                    {!! Form::checkbox('active',1,null) !!} Active
                </label>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" :disabled="imageStatus" class="btn btn-success">Submit</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">View Image</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset($slide->image) }}" alt="" style="width: 100%">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        var edit_slide_form = new Vue({
            el: '#edit_slide_form',
            data: {
                red_button_title: '',
                transparent_button_title: '',
                imagePath: '',
                message: '',
                imageStatus: false,
            },
            methods: {
                showImage: function (path) {
                    this.imagePath = path;
                    console.log(this.imagePath);
                },
                deleteImage: function (image, slideId, url) {
                    var errorObject = error;
                    axios.post(url, {
                        id: slideId
                    })
                        .then(function (response) {
//                            console.log(response.data[0]);
                            errorObject.message = response.data[0];
                            edit_slide_form.imageStatus = true;
                        })
                        .catch(function (error) {
//                            console.log(error.response);
                            errorObject.message = error.response;
                        })
                },
                imageChanged: function () {
                    this.imageStatus = false;
                }
            },
            mounted: function () {
                this.transparent_button_title = '{{ $slide->transparent_button_title }}';
                this.red_button_title = '{{ $slide->red_button_title }}';
            }
        });
    </script>
@stop
