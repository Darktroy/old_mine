@extends('layouts.site.inner_pages_layout')
@section('page_content')
    <!--Sidebar Page-->
    <div class="sidebar-page">
        <div class="row clearfix">

            <!--Content Side-->
            <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
                <section class="blog-section">
                    <div class="sec-title">
                        <h2>Our <strong>Blog</strong></h2>
                    </div>
                @foreach($posts as $post)
                    <!--Blog Post-->
                        <div class="blog-post wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <article class="column-inner">
                                <figure class="image-box">
                                    <a href="{{ url('blog/posts/'.str_replace(' ','-',$post->title)) }}"><img
                                                src="{{ asset('media/blog/posts/'.$post->postImages->first()->image) }}"
                                                alt="" title="Blog"></a>
                                    <div class="post-options">
                                        <a href="#" class="plus-icon img-circle"><span
                                                    class="flaticon-add30"></span></a>
                                        <a href="#" class="heart-icon img-circle"><span
                                                    class="flaticon-favorite21"></span></a>
                                    </div>
                                </figure>
                                <div class="lower-part">
                                    <div class="post-date"><span
                                                class="day">{{ date('d',strtotime($post->created_at)) }}</span> <span
                                                class="month">{{ date('M',strtotime($post->created_at)) }}</span></div>
                                    <h3>
                                        <a href="{{ url('blog/posts/'.str_replace(' ','-',$post->title)) }}">{{ $post->title }}</a>
                                    </h3>
                                    <div class="post-info"><a href="#"><span class="icon flaticon-user197"></span>
                                            &ensp;Jonathan Doe</a> &ensp; <a href="#"><span
                                                    class="icon flaticon-speechbubble65"></span> &ensp;31 comments</a>
                                    </div>
                                    <div class="post-text"> {{ $post->mini_description }} </div>
                                    <div class="text-right link"><a
                                                href="{{ url('blog/posts/'.str_replace(' ','-',$post->title)) }}"
                                                class="read-more"><span class="fa fa-angle-right"></span> &ensp; Read
                                            More</a></div>
                                </div>
                            </article>
                        </div>
                    @endforeach

                </section>

                <br>
                <!-- Theme Pagination -->
                @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="theme-pagination text-left">
                        {{ $posts->links('vendor.pagination.euromed') }}
                    </div>
                @endif

            </div>
            <!--Content Side-->
            @include('layouts.site.includes.blog_sidebar')


        </div>
    </div>
@stop