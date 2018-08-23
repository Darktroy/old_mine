@extends('layouts.site.country')
@section('country_account')
<style>
    td.configs{
      width:75px;
    }
    td.configs a{
      display:block;
    }
</style>
    <!-- SUB Banner -->
  <div class="profile-bnr sub-bnr user-profile-bnr">
    <div class="position-center-center">
      <div class="container">
        <h2> Country Dashboard </h2>
      </div>
    </div>
  </div>
  <!-- Compny Profile -->
  <div class="compny-profile">

    <!-- Profile Company Content -->
    <div class="profile-company-content" data-bg-color="fff">
      <div class="container">
        <div class="row">
          <!-- SIDE BAR -->
          @include('layouts.site.country_side')
          <!-- Tab Content -->
          <div class="col-md-8">
            <div class="network">
              <h4>Calls</h4>

            <!-- Nav Tabs -->
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#connec">All Calls</a></li>
                <li><a data-toggle="tab" href="#newCall">New Call</a></li>
              </ul>
              <!-- Tab Content -->
              <div class="tab-content">

                <!-- Connections -->
                <div id="connec" class="tab-pane fade in active">
                  <div class="net-work-in">
                                      <!-- Filter -->
                    <div class="filter-flower">
                      <div class="row">                        
                        <!-- Short -->
                        <div class="col-sm-5 col-sm-offset-7">
                          <select>
                            <option>Sort</option>
                            <option>Sort</option>
                            <option>Sort</option>
                            <option>Sort</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- Members -->
                    <div class="main-mem">

                      <!-- Head -->
                      <div class="head">
                        <div class="row">
                          <div class="col-sm-8">
                            <button><i class="fa fa-trash"></i>Delete</button>
                          </div>
                        </div>
                      </div>

                        {{-- Listing All Calls --}}
                        <table class="table table-striped table-bordered">
                        
                        <thead>
                        
                          <tr>
                              <th> <input id="checkbox1" class="styled" type="checkbox"> </th>
                              <th> Id </th>
                              <th>title</th>
                              <th>Looking For</th>
                              <th>Work Place</th>
                              <th>Country</th>
                              <th>DeadLine</th>
                              <th>Selection Date</th>
                              <th>Config</th>
                          </tr>
                        
                        </thead>
                        <tbody>
                            @foreach($calls as $k => $call)
                                <tr>
                                  <td> <input id="checkbox1" class="styled" type="checkbox"> </td>
                                  <td> #{{ $k+1 }} </td>
                                  <td>{{$call->title}}</td>
                                  <td>{{ $for[$call->for] }}</td>
                                  <td>{{$work_place[$call->workplace]}}</td>
                                  <td>{{$country->name}}</td>
                                  <td>{{date('Y-m-d',strtotime($call->deadline))}}</td>
                                  <td>{{date('Y-m-d',strtotime($call->selection))}}</td>
                                  <td class="configs">
                                    <a href="#"> <i class="fa fa-eye"></i> View  </a>
                                    <a href="#"> <i class="fa fa-pencil"></i> Edit  </a>
                                    <a href="#" onclick="return confirm('Are You Sur You Want To Delete ?')"> <i class="fa fa-trash-o"></i> Delete  </a>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>

                        </table>

                    </div>
                  </div>
                </div>

                <!-- Followers -->
                <div id="newCall" class="tab-pane fade">
                  <div class="net-work-in">
                    <!-- Members -->
                    <div class="main-mem">
                      @include('errors.list')
                      @if(Session::has('message'))
                          <div class="alert alert-warning alert-dismissible fade in" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                          aria-hidden="true">×</span>
                              </button>
                              {{ session('message') }}
                          </div>
                      @endif

                      @include('common.calls_form')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

@stop
