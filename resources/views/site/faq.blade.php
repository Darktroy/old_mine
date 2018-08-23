@extends('layouts.site.inner_pages_layout')
@section('page_content')
    <!-- #faq -->
    <section id="blog-post" class="faq">
        <div class="row">
            <!-- .faq-content -->
            <div class="col-lg-12 col-md-12 col-sm-12 faq-content">
                <br>
                <!-- article -->
                <article>
                    <div class="row">
                        <div class="col-lg-12 sec-title">
                            <h2>Do You Need Help</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="faq-text">
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                                    quisquam est, qui dolorem ipsum quia dolor sit amet, consect etur, adipisci velit,
                                    sed quia non numquam eius modi tempora incidunt ut labore et.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="faq-search">
                                <input type="text" name="search" placeholder="Enter Search keywords">
                                <input type="button" value="search">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="general-question">
                                <div class="panel-group" role="tablist" aria-multiselectable="true">
                                    @foreach($questions as $k => $question)
                                        <div class="panel panel-default">
                                            <div class="panel-heading headback" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                       href="#collapse_{{ $k }}" aria-expanded="true"
                                                       aria-controls="collapseOne">
                                                        {{ $question->question }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_{{ $k }}" class="panel-collapse collapse" role="tabpanel">
                                                <div class="panel-body">
                                                    <div class="panel_body_down">
                                                        <div class="panel_down_text">
                                                            <p>
                                                                {{ $question->answer }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $questions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </article> <!-- /article -->


            </div> <!-- /.Testimonials-V1 -->
        </div>
    </section> <!-- /#Testimonial-V1 -->
@stop