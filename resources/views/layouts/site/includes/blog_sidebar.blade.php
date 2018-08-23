                <!--Sidebar-->	
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <aside class="sidebar">
                    
                        <!-- Search Form -->
                        <div class="widget search-form">
                            
                            <form method="post" action="blog.html">
                                <div class="form-group">
                                    <input type="search" name="search" value="" placeholder="search for something">
                                    <button type="submit" name="submit"><span class="fa fa-search"></span></button>
                                </div>
                            </form>
                            
                        </div>
                        
                        <!-- Popular Categories -->
                        <div class="widget popular-categories wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="sec-title"><h3>Popular <strong>categories</strong></h3></div>
                            
                            <ul class="list">
                                @foreach($categories as $category)
                                    <li><span class="icon flaticon-blank36"></span> <a href="{{ url('blog/category/'.str_replace(' ','-',$category->name)) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                            
                        </div>
                        
                        <!-- Recent Posts -->
                        <div class="widget recent-posts wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="sec-title"><h3>Recent <strong>posts</strong></h3></div>
                            @foreach($recent as $post)
                                <div class="post">
                                    <div class="post-thumb"><a href="{{ url('blog/posts/'.str_replace(' ','-',$post->title)) }}"><img src="{{ asset('media/blog/posts/'.$post->postImages->first()->image) }}" alt=""></a></div>
                                    <h4><a href="{{ url('blog/posts/'.str_replace(' ','-',$post->title)) }}">{{ $post->title }}</a></h4>
                                    <div class="post-info">{{ date('M d, Y',strtotime($post->created_at)) }} in <a href="#"><em>{{ $post->category->name }}</em></a></div>
                                </div>
                            @endforeach
                            
                        </div>
                        
                        <!-- Popular Tags -->
                        <div class="widget popular-tags">
                            <div class="sec-title"><h3>Popular <strong>tags</strong></h3></div>
                            @foreach($tags as $tag)
                                <a href="#">{{$tag->tag}}</a>
                            @endforeach                             
                        </div>
                                
                    </aside>
                
                    
                </div>
                <!--Sidebar-->