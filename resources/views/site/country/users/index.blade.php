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
            <h6 class="panel-title">List All Users</h6>
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
                @foreach($users as $sub_user)
                    <div class="col-lg-3 col-md-6 user_{{ $sub_user->id }}">
                        <div class="panel panel-body">
                            <div class="media">
                                <div class="media-left">
                                    <a href="assets/images/placeholder.jpg" data-popup="lightbox">
                                        <img src="assets/images/placeholder.jpg" class="img-circle img-lg" alt="">
                                    </a>
                                </div>

                                <div class="media-body">
                                    <h6 class="media-heading">{{ $sub_user->name }}</h6>
                                    <span class="text-muted">{{ $sub_user->position }}</span>
                                </div>

                                <div class="media-right media-middle">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"><i class="icon-comment-discussion pull-right"></i> Start
                                                        chat</a></li>
                                                <li><a href="{{ url('users/edit/'.$sub_user->id) }}"><i
                                                                class="icon-pen pull-right"></i> Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#" data-token="{{ csrf_token() }}"
                                                       data-url="{{ url('country/users/'.$sub_user->id.'/delete') }}"
                                                       class="delete_user">
                                                        <i class="icon-x pull-right"></i> Delete
                                                    </a>
                                                </li>
                                                {{--<li class="divider"></li>--}}
                                                {{--<li><a href="#"><i class="icon-statistics pull-right"></i>--}}
                                                {{--Statistics</a>--}}
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $('a.delete_user').on('click', function (e) {
            e.preventDefault();
            var url = $(this).data('url');
            var token = $(this).data('token');
            var form = new Form();
            if (confirm('Are You Sure You Want To Delete This user')) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'_token': token},
                    success: function (response) {
                        $('.user_' + response.id).slideUp(600);
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
