@extends('layouts.site.inner_pages_layout')
@section('page_content')

    <!--Services Section-->
    <section class="services-section about-section">

        <div class="sec-title">
            <h2>{{ $data->title }}</h2>
        </div>
        <div class="sec-text">
            <p>
                {!! $data->description !!}
            </p>
        </div>

    </section>
@stop