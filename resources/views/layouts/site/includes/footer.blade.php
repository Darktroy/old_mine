<footer class="main-footer">

    <!--Footer Upper-->
    <div class="footer-upper">
        <div class="auto-container">
            <div class="clearfix">

                <!--Two 4th column-->
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="row clearfix">

                        <!--Footer Column-->
                        <div class="col-md-6 col-sm-6 col-xs-12 column">
                            <div class="footer-widget about-widget">
                                <h2>About <strong>Us</strong></h2>
                                <p>{{ mb_substr(\App\Models\SiteConfig::getValueByKey('desc'),0,300) }}</p>
                                <div class="social-links">
                                    <a href="{{ \App\Models\SiteConfig::getValueByKey('facebook') }}" class="fa fa-facebook-f"></a>
                                    <a href="{{ \App\Models\SiteConfig::getValueByKey('twitter') }}" class="fa fa-twitter"></a>
                                    <a href="{{ \App\Models\SiteConfig::getValueByKey('linked') }}" class="fa fa-linkedin"></a>
                                </div>
                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="col-md-6 col-sm-6 col-xs-12 column">
                            <div class="footer-widget recent-posts">
                                <h2>Recent <strong>Posts</strong></h2>
                                @foreach($latestPostst as $post)
                                    <div class="post">
                                        <h4><a href="{{ url('blog/posts/'.str_replace(' ','-',$post->title)) }}">{{ $post->title }}</a></h4>
                                        <div class="post-info"> {{ date('M d, Y') }}  / <a href="#">31 comments</a></div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>

                <!--Two 4th column-->
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="row clearfix">
                        <!--Footer Column-->
                        <div class="col-md-6 col-sm-6 col-xs-12 column">
                            <div class="footer-widget twitter-feeds">
                                <h2>Recent <strong>Tweets</strong></h2>
                                <div class="feed">
                                    <div class="icon"><span class="fa fa-twitter"></span></div>
                                    <div class="feed-content">Check out our donation programs here <a href="#">@http://t.co/8dfkjht</a></div>
                                    <div class="time text-right"><em>15 mins ago</em></div>
                                </div>

                                <div class="feed">
                                    <div class="icon"><span class="fa fa-twitter"></span></div>
                                    <div class="feed-content">Help our children in south  africa  <a href="#">@http://t.co/7gfkjht</a></div>
                                    <div class="time text-right"><em>15 mins ago</em></div>
                                </div>

                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="col-md-6 col-sm-6 col-xs-12 column">
                            <div class="footer-widget popular-tags">
                                <h2>Popular <strong>Tags</strong></h2>
                                @foreach($tags as $tag)
                                    <a href="#">{{$tag->tag}}</a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <!--Copyright-->
            <div class="copyright">Copyright 2015 by <strong>Volunteer - Charity and Fundraising PSD Template</strong> | All rights reserved</div>
        </div>
    </div>

</footer>