<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
{{--<script src="{{ asset('js/pdf.js') }}"></script>--}}
{{--<link rel="stylesheet" href="{{ asset('css/pdf.css') }}">--}}


<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$user->name}}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center">
                            @if(auth()->user()->type==1)
                                <img alt="User Pic" src="{{ asset('media/flags/'.$user->country->flag) }}"
                                     class="img-circle img-responsive"></div>
                        @else
                            <img alt="User Pic" src="{{ asset($user->image) }}"
                                 class="img-circle img-responsive"></div>
                @endif

                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                          <dl>
                            <dt>DEPARTMENT:</dt>
                            <dd>Administrator</dd>
                            <dt>HIRE DATE</dt>
                            <dd>11/12/2013</dd>
                            <dt>DATE OF BIRTH</dt>
                               <dd>11/12/2013</dd>
                            <dt>GENDER</dt>
                            <dd>Male</dd>
                          </dl>
                        </div>-->
                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                            <tr>
                                <td>Name</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Nationality</td>
                                <td>{{$user->nationality}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                            </tr>
                            <td>Phone Number</td>
                            <td>{{$user->phone}}</td>
                            <td>Tel Number</td>
                            <td>{{$user->tel}}</td>
                            @if(auth()->user()->type == 1)
                                <td>Description Country</td>
                                <td>{{$user->country->description}}</td>
                                @endif

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button"
                   class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
            </div>
        </div>
    </div>
</div>
</div>