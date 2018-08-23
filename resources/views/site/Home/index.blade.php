@extends('layouts.site.app')

@section('content')
    <!-- Main Slider -->
    @include('site.Home.slider')

    <!-- Company Section -->
    @include('site.Home.company_section')

    <!-- volunteering Section -->
    @include('site.Home.volunteering')

    <!-- statistics Section -->
    @include('site.Home.statistics')

    <!-- statistics Section -->
    @include('site.Home.contact_sponsors')

    @if (session('status'))
        <div class="alert alert-success">
            {!! session('status')  !!}
        </div>
    @endif

@endsection
