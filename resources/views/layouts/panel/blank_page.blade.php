@extends('layouts.panel.main')

@section('content')

    <!-- page content -->

    <div class="page-title">
        <div class="title_left">
            <h3>{{ $page_title }}</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                @if($search)
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $sub_title }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="blank">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                            </button>
                            {{ session('message') }}
                        </div>
                    @endif
                    @if($errors->any())
                        @include('errors.list')
                    @endif
                    <div id="error">
                        <div class="alert alert-warning alert-dismissible fade in" v-if="message"
                             role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                            </button>
                            @{{ message }}
                        </div>
                    </div>
                    @yield('plank_content')
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@stop

@section('scripts')
    <script>

    </script>
@stop