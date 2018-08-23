@if(isset($slides))
                    @foreach($slides as $slide)
                        @if(!empty($slide->red_button_title) || !empty($slide->transparent_button_title))
                            <li data-transition="slideup" data-slotamount="1" data-masterspeed="1000"
                                data-thumb="{{ asset('media/slider/'.$slide->image_name) }}" data-saveperformance="off"
                                data-title="{{ $slide->title }}">
                                <img src="{{ asset('media/slider/'.$slide->image_name) }}" alt=""
                                     data-bgposition="center top"
                                     data-bgfit="cover"
                                     data-bgrepeat="no-repeat">

                                <div class="tp-caption lfl tp-resizeme"
                                     data-x="center" data-hoffset="0"
                                     data-y="center" data-voffset="-24"
                                     data-speed="1500"
                                     data-start="500"
                                     data-easing="easeOutExpo"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.01"
                                     data-endelementdelay="0.3"
                                     data-endspeed="1200"
                                     data-endeasing="Power4.easeIn"
                                     style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                                    <div class="title with-bg"><h2>{{ $slide->title }}</h2></div>
                                </div>

                                <div class="tp-caption lfr tp-resizeme"
                                     data-x="center" data-hoffset="0"
                                     data-y="center" data-voffset="42"
                                     data-speed="1500"
                                     data-start="500"
                                     data-easing="easeOutExpo"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.01"
                                     data-endelementdelay="0.3"
                                     data-endspeed="1200"
                                     data-endeasing="Power4.easeIn"
                                     style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                                    <div class="text with-bg"><h4>{{ $slide->caption }}</h4>
                                    </div>
                                </div>

                                <div class="tp-caption lfb tp-resizeme"
                                     data-x="center" data-hoffset="-80"
                                     data-y="center" data-voffset="110"
                                     data-speed="1500"
                                     data-start="1000"
                                     data-easing="easeOutExpo"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.01"
                                     data-endelementdelay="0.3"
                                     data-endspeed="1200"
                                     data-endeasing="Power4.easeIn"
                                     style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                                    <div class="link-btn">
                                        <a href="{{ url($slide->transparent_button_url) }}"
                                           class="theme-btn light-btn">
                                            {{$slide->transparent_button_title }}
                                        </a>
                                    </div>
                                </div>

                                <div class="tp-caption lfb tp-resizeme"
                                     data-x="center" data-hoffset="80"
                                     data-y="center" data-voffset="110"
                                     data-speed="1500"
                                     data-start="1000"
                                     data-easing="easeOutExpo"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.01"
                                     data-endelementdelay="0.3"
                                     data-endspeed="1200"
                                     data-endeasing="Power4.easeIn"
                                     style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                                    <div class="link-btn">
                                        <a href="{{ $slide->red_button_url }}" class="theme-btn dark-btn">
                                            {{$slide->red_button_title}}
                                        </a>
                                    </div>
                                </div>


                            </li>
                        @else
                            <li data-transition="fade" data-slotamount="1" data-masterspeed="1000"
                                data-thumb="{{ asset($slide->image) }}" data-saveperformance="off"
                                data-title="Donation is Better">
                                <img src="{{ asset($slide->image) }}" alt="" data-bgposition="center top"
                                     data-bgfit="cover"
                                     data-bgrepeat="no-repeat">

                                <div class="tp-caption lft tp-resizeme"
                                     data-x="center" data-hoffset="0"
                                     data-y="center" data-voffset="-24"
                                     data-speed="1500"
                                     data-start="500"
                                     data-easing="easeOutExpo"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.01"
                                     data-endelementdelay="0.3"
                                     data-endspeed="1200"
                                     data-endeasing="Power4.easeIn"
                                     style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                                    <div class="title"><h2>{{ $slide->title }}</h2></div>
                                </div>

                                <div class="tp-caption lfb tp-resizeme"
                                     data-x="center" data-hoffset="0"
                                     data-y="center" data-voffset="32"
                                     data-speed="1500"
                                     data-start="500"
                                     data-easing="easeOutExpo"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.01"
                                     data-endelementdelay="0.3"
                                     data-endspeed="1200"
                                     data-endeasing="Power4.easeIn"
                                     style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                                    <div class="text"><h4> {{ $slide->caption }} </h4></div>
                                </div>

                                <div class="tp-caption lfb tp-resizeme"
                                     data-x="center" data-hoffset="0"
                                     data-y="center" data-voffset="70"
                                     data-speed="1500"
                                     data-start="1000"
                                     data-easing="easeOutExpo"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-elementdelay="0.01"
                                     data-endelementdelay="0.3"
                                     data-endspeed="1200"
                                     data-endeasing="Power4.easeIn"
                                     style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">
                                    <div class="line"></div>
                                </div>

                            </li>
                        @endif
                    @endforeach
                @endif