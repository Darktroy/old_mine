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

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Edit {{ $post->title }}</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>

        <div class="panel-body posts_form">
            {!! Form::model($post,['url'=>"country/topics/$post->id/edit",'method' => 'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::label('title','Title: ') !!}
                        {!! Form::text('title',null,['class'=>'']) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('category_id','Category: ') !!}
                        {!! Form::select('category_id',$categories,null,['class'=>'form-control','id'=>'category']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <div class="poster">
                            <label class="display-block">Poster </label>
                            <input type="file" name="images[]" class="file-styled">
                            <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                        </div>
                        <div class="subImages">
                            @foreach($post->postImages as $image)
                                <div class="image image_{{$image->id}}" style="float: left; margin-bottom: 5px;">
                                    <img src="{{ asset('media/blog/posts/'.$image->image) }}"
                                         style="height: 150px; width: 150px; display: block; margin-left: 5px;" alt="">
                                    <div class="config"
                                         style=" background: red;  height: 100%; width: 96.5%; text-align: center; margin-left: 5px; float: left;display: block">
                                        <a href="#" class="deleteImage" data-token="{{ csrf_token() }}"
                                           data-url="{{ url('country/topics/images/'.$image->id.'/delete') }}"
                                           style="font-size: 20px; color: #fff; display: block; width: 100%"><i
                                                    class="fa fa-trash-o"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="tags"> Tags </label>
                        {!! Form::select('tags[]',$posts_tags,$post->tags->pluck('tag')->toArray(),['class'=>'form-control','id'=>'tags','multiple'=>'multiple']) !!}
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="mini_description"> Min Description </label>
                        {!! Form::textarea('mini_description',null,['class'=>'form-control','rows'=>5,'max'=>150]) !!}
                    </div>
                    <div class="col-md-12">
                        <label for="Description"> Description </label>
                        {!! Form::textarea('description',null,['class'=>'form-control add_tiny']) !!}
                    </div>
                </div>
            </div>

            <div class="checkbox" style="display: inline;">
                {!! Form::checkbox('active','1',null,['id'=>'active']) !!}
                <label for="active" style="padding-left: 5px;">Active</label>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i>
                </button>
            </div>
            {!! Form::close() !!}


        </div>
    </div>
    <!-- /profile info -->

@stop

@section('scripts')
    {{--  <script type="text/javascript" src="{{ asset('js/jquery.timepicker.js') }}"></script>  --}}
    {{--  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>  --}}
    {{--  <script src="{{ asset('panel/tinymce/tinymce.min.js') }}"></script>  --}}
    <script>
        $('select').select2();
        $('input.timepicker').timepicker({});

        $('a.deleteImage').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var token = $(this).data('token');
            var form = new Form();
            if (confirm('Are You Sure You Want To Delete This Image')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'_token': token},
                    success: function (response) {
                        $('.image_' + response.id).slideUp(600);
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


