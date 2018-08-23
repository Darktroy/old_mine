@extends('layouts.panel.blank_page')
@section('plank_content')
    <div class="table-responsive" id="view_application">
        <table class="table table-striped jambo_table bulk_action">
            @foreach($country_cities as $data)
                <tr class="heading-form">
                    <td class="column-title"><b> Country Name </b></td>
                    <td class="heading-form">{{$data->country_name}}</td>
                </tr>
                <tr lass="heading-form">
                    <td class="column-title"> City Name</td>
                    <td class="heading-form">{{$data->city_name}}</td>
                </tr>
            @endforeach

            <tr class="heading-form">
                <td class="column-title"><b> Organization Name </b></td>
                <td class="heading-form">{{$applications->org_name}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Department Name </b></td>
                <td class="heading-form">{{$applications->dep_name}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Acronym </b></td>
                <td class="heading-form">{{$applications->acronym}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Private Link </b></td>
                <td class="heading-form">{{$applications->private_link}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Email </b></td>
                <td class="heading-form">{{$applications->email}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Belong to </b></td>
                <td class="heading-form">{{$applications->belong_to}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Organization Type </b></td>
                <td class="heading-form">{{$applications->org_type}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Status </b></td>
                <td class="heading-form">{{$applications->status}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Address </b></td>
                <td class="heading-form">{{$applications->address}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Website </b></td>
                <td class="heading-form">{{$applications->website}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Postal code </b></td>
                <td class="heading-form">{{$applications->postal_code}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Manager Name </b></td>
                <td class="heading-form">{{$applications->manager_name}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> First Name </b></td>
                <td class="heading-form">{{$applications->first_name}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Last Name </b></td>
                <td class="heading-form">{{$applications->last_name}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Selected by </b></td>
                <td class="heading-form">{{$applications->selected_by}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Facebook Link </b></td>
                <td class="heading-form"><a
                            href="{{$applications->facebook_link}}"> {{$applications->facebook_link}} </a></td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Twitter Link </b></td>
                <td class="heading-form"><a href="{{$applications->twitter_link}}"> {{$applications->twitter_link}} </a>
                </td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Linked-in Link </b></td>
                <td class="heading-form"><a href="{{$applications->linked_link}}"> {{$applications->linked_link}} </a>
                </td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> About Us </b></td>
                <td class="heading-form">{{$app_details->about_us}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Established on </b></td>
                <td class="heading-form">{{$app_details->established_on}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Number of Employee </b></td>
                <td class="heading-form">{{$app_details->no_of_emp}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Number of Members </b></td>
                <td class="heading-form">{{$app_details->no_of_mem}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Services description </b></td>
                <td class="heading-form">{{$app_details->services_desc}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Your suggested contribution </b></td>
                <td class="heading-form">{{$app_details->suggested_contribution}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> How can you support us? </b></td>
                <td class="heading-form">{{$app_details->support_us}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Can you organize a social campaign for "Made in EuroMed" idea? No </b></td>
                <td class="heading-form">{{$app_details->clarifications}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Can you organize a social campaign for "Made in EuroMed" idea? Yes </b>
                </td>
                <td class="heading-form">{{$app_details->suggest_plan}}</td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Logo </b></td>
                <td class="heading-form"><img src="{{ asset('media/files/'.$app_details->logo) }}"
                            alt="" height="50" width="50"></td>
            </tr>

            <tr class="heading-form">
                <td class="column-title"><b> Other Documentation </b></td>
                <td class="heading-form">{{$app_details->other_doc}}</td>
            </tr>
        </table>

        <br>
        <h3> Contact Phones </h3>
        <br>
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <td class="column-title"><b> Tel </b></td>
                <td class="column-title"> Mobile</td>
                <td class="column-title"> Ext</td>
                <td class="column-title"> Fax</td>
            </tr>
            </thead>
            <tbody>
            @foreach($contact_phones as $data)
                <tr>
                    <td class="heading-form">{{$data->tel}}</td>
                    <td class="heading-form">{{$data->phone}}</td>
                    <td class="heading-form">{{$data->ext}}</td>
                    <td class="heading-form">{{$data->fax}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br>
        <h3> Contact Persons </h3>
        <br>
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">
                <th class="column-title">First Name</th>
                <th class="column-title">Last Name</th>
                <th class="column-title">Department Name</th>
                <th class="column-title">Position Name</th>
                <th class="column-title">Tel</th>
                <th class="column-title">Ext</th>
                <th class="column-title">Mobile</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contact_persons as $person)
                <tr>
                    <td class="heading-form">{{$person->first_name}}</td>
                    <td class="heading-form">{{$person->last_name}}</td>
                    <td class="heading-form">{{$person->department}}</td>
                    <td class="heading-form">{{$person->position}}</td>
                    <td class="heading-form">{{$person->tel}}</td>
                    <td class="heading-form">{{$person->ext}}</td>
                    <td class="heading-form">{{$person->mobile}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('styles')
    <style>
        b {
            font: bold;
            color: #000000;
        }
    </style>
@stop