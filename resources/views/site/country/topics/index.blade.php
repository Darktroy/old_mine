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
            <h6 class="panel-title">List All Topics</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{--<li><a data-action="collapse"></a></li>--}}
                    <li><a data-action="reload"></a></li>
                    {{--<li><a data-action="close"></a></li>--}}
                </ul>
            </div>
        </div>
        <hr>
        <div class="panel-body">
            <div class="row">
                @if(isset($position) && $position ==2 )
                    <?php $filterBy = $country_id . '/' . $position; ?>
                @else
                    <?php $filterBy = auth()->user()->id . '/' . $position; ?>
                @endif
                @if($topics && count($topics) >= 1)
                    @foreach($topics as $post)
                        <div class="col-md-4 topic_{{ $post->id }}">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="thumb content-group">
                                        {{--{{ dd($post->postImages->first()->image) }}--}}
                                        <img src="{{ (!empty($post->postImages)  && count($post->postImages) >= 1) ? asset('media/blog/posts/'.$post->postImages->first()->image) : '' }}"
                                             alt="" class="img-responsive">
                                        {{--<div class="caption-overflow">--}}
                                        {{--<span>--}}
                                        {{--<a href="blog_single.html"--}}
                                        {{--class="btn btn-flat border-white text-white btn-rounded btn-icon"><i--}}
                                        {{--class="icon-arrow-right8"></i></a>--}}
                                        {{--</span>--}}
                                        {{--</div>--}}
                                    </div>

                                    <h5 class="text-semibold mb-5">
                                        <a href="#" class="text-default">{{ $post->title }}</a>
                                    </h5>

                                    <ul class="list-inline list-inline-separate text-muted content-group">
                                        <li>By <a href="#" class="text-muted">{{ $post->user->name }}</a></li>
                                        <li> {{ date('F d\t\h, Y',strtotime($post->created_at)) }}</li>
                                    </ul>

                                    {{ $post->mini_description }}
                                </div>

                                <div class="panel-footer panel-footer-condensed">
                                    <div class="heading-elements not-collapsible">
                                        <ul class="list-inline list-inline-separate heading-text text-muted">
                                            {{--<li><a href="#" class="text-muted"><i--}}
                                            {{--class="icon-heart6 text-size-base text-pink position-left"></i>--}}
                                            {{--29</a></li>--}}
                                        </ul>
                                        @if(!empty(auth()->user()))
                                        <a href="{{ url('country/topics/edit/'.$post->id.'/'.$filterBy) }}"
                                           class="heading-text pull-left"> <i
                                                    class="icon-arrow-left13 position-right"></i>
                                            Edit </a>
                                        <a href="#" data-url="{{ url('country/topics/'.$post->id.'/delete') }}"
                                           data-token="{{ csrf_token() }}" class="heading-text delete_topic pull-right">
                                            <i
                                                    class=" icon-x position-right"></i> Delete </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2> No Topics Yet </h2>
                @endif
            </div>
        </div>
    </div>
    <!-- /profile info -->

@stop

@section('scripts')
    <script>
        $('a.delete_topic').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var token = $(this).data('token');
            var form = new Form();
            if (confirm('Are You Sure You Want To Delete This Post')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'_token': token},
                    success: function (response) {
                        console.log(response);
                        $('.topic_' + response.id).slideUp(600);
                        var text = `<div class="activity-item">
                        <i class="fa fa-flag-checkered" aria-hidden="true"></i>
                        <div class="activity" style="display:inline; margin-left:15px;"> ${response.success} </div> </div>
                        `;
                        form.errors.notification('information', text);
                    }
                });
            }
        });
    </script>
@stop


