<section class="two-column no-padd-bottom">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Text Column-->
            <div class="col-md-6 col-sm-12 col-xs-12 wow fadeInLeft animated" data-wow-delay="0ms"
                 data-wow-duration="1500ms"
                 style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                <div class="text-column">
                    <div class="sec-title">
                        <h2>Become a part of <strong> the world</strong></h2>
                    </div>
                    <div class="text">
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                            invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
                            et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                            Lorem ipsum dolor sit amet. <br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                            voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
                    </div>
                    <br>
                    <div class="link text-right"><a href="#" class="theme-btn read-more"><span
                                    class="fa fa-angle-right"></span> &ensp;Read More</a></div>
                </div>
            </div>

            <!--Video Column-->
            <div class="col-md-6 col-sm-12 col-xs-12 wow fadeInRight animated" data-wow-delay="0ms"
                 data-wow-duration="1500ms"
                 style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInRight;">
                <div class="responsive-video">
                    <div class="fluid-width-video-wrapper" style="padding-top: 56.6667%;">
                        <iframe allowfullscreen="" src="//player.vimeo.com/video/56999995?color=ffffff"
                                id="fitvid0"></iframe>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>


<section class="four-column current-projects no-padd-top">
    <div class="auto-container">
        <div class="sec-title clearfix">
            <h2 class="pull-left">Our current <strong>projects</strong></h2>
            <div class="link pull-right"><a href="#"><span class="fa fa-angle-right"></span> See All</a></div>
        </div>

        <div class="row clearfix">

        @if(isset($posts))
            @foreach($posts as $post)
                <!--Project Column-->
                    <div class="col-md-3 col-sm-6 col-xs-12 column project-column wow fadeInLeft animated"
                         data-wow-delay="0ms"
                         data-wow-duration="1000ms"
                         style="visibility: visible; animation-duration: 1000ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                        <article class="column-inner hvr-float-shadow">
                            <figure class="image-box">
                                @if(!empty($post->postImages) && !empty($post->postImages->first()))
                                    <a href="{{ url('media/blog/posts/'.str_replace(' ','-',$post->title)) }}"><img
                                                src="{{ asset('media/blog/posts/'.$post->postImages->first()->image) }}"
                                                alt="" title="Volunteer"></a>
                                @endif
                                <div class="icon-box">
                                    <a href="#" class="heart-icon img-circle"><span
                                                class="flaticon-favorite21"></span></a></div>
                            </figure>
                            <div class="lower-part">
                                <div class="text">
                                    <h3>
                                        <a href="{{ url('media/blog/posts/'.str_replace(' ','-',$post->title)) }}">{{ $post->title }}</a>
                                    </h3>
                                    <p>{{ $post->mini_description }}</p>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</section>
