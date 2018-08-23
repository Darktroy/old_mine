@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="row">
        <div id="new_slide_form">
            {!! Form::model($post,['id'=>'demo-form2','data-parsley-validate','class'=>'form-horizontal form-label-left','files'=>true])  !!}

            <div class="form-group">
                {!! Form::label('title','Title :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('title',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('images[]','image :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <button class="btn btn-primary add_image"> Add Image </button>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::file('images[]',['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-3 col-sm-3 col-xs-12"></label>
                <div class="images col-md-7 col-xs-12">
                    <div class="subImages">
                        @foreach($post->postImages as $image)
                            <div class="image image_{{$image->id}}" style="float: left; margin-bottom: 5px;">
                                <img src="{{ asset('media/blog/posts/'.$image->image) }}" style="height: 150px; width: 150px; display: block; margin-left: 5px;" alt="">
                                <div class="config" style=" background: red;  height: 100%; width: 96.5%; text-align: center; margin-left: 5px; float: left;display: block">
                                    <a href="#" class="deleteImage" data-token="{{ csrf_token() }}" data-url="{{ url('panel/blog/posts/images/'.$image->id.'/delete') }}" style="font-size: 20px; color: #fff; display: block; width: 100%"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group mini_description">
                {!! Form::label('mini_description','Mini Description :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('mini_description',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description','Description :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('description',null,['class'=>'form-control col-md-7 col-xs-12 add_tiny']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('category_id','Category :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::select('category_id',$categories,null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('tag_id','Tag :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="tags" style="margin-bottom:10px;">
                        @foreach($post->tags as $tag)
                            <span class="label label-primary" style="margin-left:5px;">{{ $tag->tag }} <a href="#" style="color:#fff;" class="delete_anch"><i class="fa fa-times"></i></a>  <input type="hidden" name="post_tags[]" value="{{ $tag->id }}"> </span>
                        @endforeach
                    </div>
                    {!! Form::text('tags','',['id'=>'magicsuggest','class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('meta_title','Meta Title :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::text('meta_title',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('meta_description','Meta Description :',['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::textarea('meta_description',null,['class'=>'form-control col-md-7 col-xs-12']) !!}
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
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ asset('panel/js/magicsuggest-min.js') }}"></script>
    <script>
        $('#all_tags').on('change',function(){
            var text = $("#all_tags option:selected").text();
            var value = $(this).val();
            $('.tags').append('<span class="label label-primary id_'+value+'"style="margin-left:5px;">'+ text +'<a href="#" style="margin-left:3px; color:#fff;" class="delete_anch"><i class="fa fa-times"></i></a> <input type="hidden" name="tags[]" value="'+value+'"> </span>');
            // $('.tags').append('')
        });

        $('.tags').on('click','a.delete_anch',function(e) {
            e.preventDefault();
            $(this).parent().remove();
        });

        var tags_array = "{{implode(',',$tags)}}";
        var tags = tags_array.split(',');

        $('#magicsuggest').magicSuggest({
            data: tags
        });
    </script>
@stop