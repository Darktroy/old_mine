@extends('layouts.site.company')
@section('profile_pages')
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


    <div class="panel panel-flat " id="calls">
        <div class="panel-heading">
            <h6 class="panel-title">Company Calls</h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>

            </div>
        </div>

        <div class="panel-body" id="filter">
            <div class="filter col-md-3 col-xs-12 col-md-offset-9">
                <select class="form-control filter_options" @change="filter('{{ url('company/calls/filter/') }}')"  v-model="selected" id="">
                    <option disabled value=""> Filter Calls</option>
                    <option value="active"> Active</option>
                    <option value="approved"> Approved</option>
                    <option value="unactive"> UnActive</option>
                    <option value="all"> All</option>
                </select>
            </div>
        </div>
        <div class="table-responsive" id="calls_listing">
            <call-record v-if="calls_status" v-bind:calls="calls" v-bind:looking_for="looking_for"
                         v-bind:places="places"></call-record>
        </div>
    </div>
    <div class="paginate">
        {{ $calls->links() }}
    </div>
    <br>
    <!-- /profile info -->

    <template id="call-record">
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th class="col-lg-1">ID</th>
                    <th class="col-lg-3">Title</th>
                    <th class="col-lg-1">Looking For</th>
                    <th class="col-lg-1">Work Place</th>
                    <th class="col-lg-2"> Target Country</th>
                    <th class="col-lg-1"> Start Date</th>
                    <th class="col-lg-1"> End Date</th>
                    <th class="col-lg-3"> Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(call ,k ) in calls">
                    <td v-text="`${k+1}`"></td>
                    <td v-text="`${call.title}`"></td>
                    <td v-text="`${looking_for[call.for]}`"></td>
                    <td v-text="`${places[call.workplace]}`"></td>
                    <td><span v-for="(country , k) in call.call_countries" v-text="country.name"
                              class="help-block"></span></td>
                    <td v-text="call.from"></td>
                    <td v-text="call.to"></td>
                    <td>
                        <a href="#" class="btn btn-xs btn-info"> <i class="fa fa-edit"></i> </a>
                        <a href="#" class="btn btn-xs btn-danger"> <i class="fa fa-trash-o"></i> </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </template>

@stop

@section('scripts')
    <script src="{{ asset('site/js/company_calls.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@stop