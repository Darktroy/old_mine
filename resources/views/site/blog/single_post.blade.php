@extends('layouts.site.inner_pages_layout')
@section('page_content')

    <style>
        .reset{
            display: table !important;
        }
    </style>

    <div class="sidebar-page">

        <div class="row clearfix">

            <!--Content Side-->
            <div class="col-lg-9 col-md-8 col-sm-6 col-xs-12">
                <section class="blog-section blog-detail">
                    <div class="sec-title">
                        <h2> {{ $post->title }}</h2>
                    </div>

                    <!--Blog Post-->
                    <div class="blog-post">
                        <article class="column-inner">
                            <figure class="image-box with-carousel">
                                <!--Image Carousel-->
                                <div class="image-carousel">
                                    <ul class="slider">
                                        @foreach($post->postImages as $image)
                                            <li class="slide-item"><img
                                                        src="{{ asset('media/blog/posts/'.$image->image) }}"
                                                        alt=""></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="post-options">
                                    <a href="#" class="plus-icon img-circle"><span class="flaticon-add30"></span></a>
                                    <a href="#" class="heart-icon img-circle"><span class="flaticon-favorite21"></span></a>
                                </div>
                            </figure>
                            <div class="lower-part">
                                <div class="post-date"><span
                                            class="day">{{ date('d',strtotime($post->created_at)) }}</span> <span
                                            class="month">APR</span></div>
                                <h3><a href="#">{{ $post->title }}</a></h3>
                                <div class="post-info"><a href="#"><span class="icon flaticon-user197"></span> &ensp;Jonathan
                                        Doe</a> &ensp; <a href="#"><span class="icon flaticon-speechbubble65"></span>
                                        &ensp;24 comments</a></div>
                                <div class="post-text">
                                    {!! $post->description !!}
                                </div>
                            </div>
                        </article>

                        <!--About Author-->
                        <div class="about-author wow fadeIn" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <h3 class="skew-lines">ABOUT THE AUTHOR</h3>
                            <div class="author-info"><strong>Jonathan Doe</strong> / 24 Blogposts / Entrepreneur / works
                                for Company Inc.
                            </div>
                            <div class="author-desc">
                                <div class="author-thumb"><img src="images/resource/author-thumb.jpg" alt=""></div>
                                <div class="text">“Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse
                                    molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et
                                    accumsan et iusto odio.”
                                </div>
                            </div>
                        </div>

                        <!--Comments Area-->
                        <div class="comments-area">
                            <div class="sec-title"><h2 class="skew-lines">User <strong>comment</strong></h2></div>
                            <div class="comment-box">
                                <div class="comment wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <div class="author-thumb"><img src="images/resource/author-thumb-2.jpg" alt="">
                                    </div>
                                    <div class="comment-info"><strong>Johnathan Doe</strong> - posted 2 minutes ago
                                    </div>
                                    <div class="text">Whether you need to create a brand from scratch, including
                                        marketing materials and a beautiful and functional website or whether you are
                                        looking for a design.
                                    </div>
                                    <a href="#" class="theme-btn dark-btn reply-btn"><span
                                                class="flaticon-update22"></span>&ensp; Reply</a>
                                </div>

                                <div class="comment reply-comment wow fadeInUp" data-wow-delay="0ms"
                                     data-wow-duration="1500ms">
                                    <div class="author-thumb"><img src="images/resource/author-thumb-3.jpg" alt="">
                                    </div>
                                    <div class="comment-info"><strong>Johnathan Doe</strong> - posted 2 minutes ago
                                    </div>
                                    <div class="text">Whether you need to create a brand from scratch, including
                                        marketing materials and a beautiful and functional website or whether you are
                                        looking for a design.
                                    </div>
                                    <a href="#" class="theme-btn dark-btn reply-btn"><span
                                                class="flaticon-update22"></span>&ensp; Reply</a>
                                </div>

                                <div class="comment wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                                    <div class="author-thumb"><img src="images/resource/author-thumb-2.jpg" alt="">
                                    </div>
                                    <div class="comment-info"><strong>Johnathan Doe</strong> - posted 2 minutes ago
                                    </div>
                                    <div class="text">Whether you need to create a brand from scratch, including
                                        marketing materials and a beautiful and functional website or whether you are
                                        looking for a design.
                                    </div>
                                    <a href="#" class="theme-btn dark-btn reply-btn"><span
                                                class="flaticon-update22"></span>&ensp; Reply</a>
                                </div>

                            </div>
                        </div>


                        <!-- Comment Form -->
                        <div class="comment-form wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">

                            <div class="sec-title"><h2 class="skew-lines">Post a <strong>comment</strong></h2></div>

                            <!--Comment Form-->
                            <form method="post" action="blog.html">
                                <div class="row clearfix">
                                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group-inner">
                                            <div class="icon-box"><label for="your-name"><span
                                                            class="icon flaticon-user168"></span></label></div>
                                            <div class="field-outer">
                                                <input type="text" name="username" id="your-name"
                                                       placeholder="Your Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group-inner">
                                            <div class="icon-box"><label for="your-email"><span
                                                            class="icon flaticon-new100"></span></label></div>
                                            <div class="field-outer">
                                                <input type="email" name="email" id="your-email" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group-inner">
                                            <textarea name="message" placeholder="Your Message"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 text-right">
                                        <button class="hvr-bounce-to-right" type="submit" name="submit-form">Send
                                            Message &ensp; <span class="icon flaticon-envelope32"></span></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>


                </section>

                <br>
                <!-- Theme Pagination -->


            </div>
            <!--Content Side-->
            @include('layouts.site.includes.blog_sidebar')

        </div>

    </div>
@stop