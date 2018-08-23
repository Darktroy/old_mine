@extends('layouts.site.inner_pages_layout')
@section('page_content')
    <!--Services Section-->
    <section class="services-section about-section">
        <div class="sec-title">
            <h2> GeoLocation </h2>
        </div>
        <div class="sec-text">
            <div class="poster">
                <img src="{{ asset(\App\Models\SiteConfig::getValueByKey('geo_image')) }}" alt="">
            </div>
            <hr>
            <p>
                {{ \App\Models\SiteConfig::getValueByKey('geo_description') }}
            </p>
        </div>
    </section>
@stop