{{-- Contact --}}

<section id="contact_form" class="contact-section">
    <div class="auto-container">
        <div class="sec-title">
            <h2>Contact <strong>us</strong></h2>
        </div>
        <div class="sec-text">
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                et dolore magna aliquyam erat, sed diam voluptua. <br>At vero eos et accusam et justo duo dolores et ea
                rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        </div>
        <div class="form">

            <form id="contact-form" method="post" action="sendemail.php" novalidate="novalidate"
                  @submit.prevent="submitForm" @keydown="form.errors.clearError($event.target.name)">
            {{ csrf_field() }}
            <input type="hidden" name="url" v-model="url" value="{{url('/home/contact_us')}}">
            <div class="row clearfix">
                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group-inner">
                        <div class="icon-box">
                            <label for="your-name"><span
                                        class="icon flaticon-user168"></span></label></div>
                        <div class="field-outer">
                            <input type="text" name="name" v-model="form.name" id="your-name" placeholder="Your Name">
                        </div>
                        <span v-if="form.errors.has('name')" class="label label-danger" v-text="form.errors.getError
                            ('name')">
                            </span>
                    </div>
                </div>
                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                    <div class="form-group-inner">
                        <div class="icon-box"><label for="your-email"><span
                                        class="icon flaticon-new100"></span></label></div>
                        <div class="field-outer">
                            <input type="email" name="email" v-model="form.email" id="your-email" placeholder="Email">
                        </div>
                        <span v-if="form.errors.has('email')" class="label label-danger" v-text="form.errors.getError
                            ('email')">
                            </span>
                    </div>
                </div>
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group-inner">
                        <div class="icon-box"><label for="your-subject"><span
                                        class="icon flaticon-edition2"></span></label>
                        </div>
                        <div class="field-outer">
                            <input type="text" name="subject" v-model="form.subject" id="your-subject"
                                   placeholder="Subject">
                        </div>
                        <span v-if="form.errors.has('subject')" class="label label-danger" v-text="form.errors.getError
                            ('subject')">
                            </span>
                    </div>
                </div>
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group-inner">
                        <textarea name="message" placeholder="Your Message" v-model="form.message"></textarea>
                        <span v-if="form.errors.has('message')" class="label label-danger" v-text="form.errors.getError
                            ('message')">
                            </span>
                    </div>
                </div>

                <div class="form-group col-md-12 col-sm-12 col-xs-12 text-right">
                    <button class="hvr-bounce-to-right" type="submit" name="submit-form">Send Message &ensp; <span
                                class="icon flaticon-envelope32"></span></button>
                </div>
            </div>
            </form>

        </div>
    </div>
</section>

{{-- Map --}}

{{--<section class="map-section">--}}
    {{--<div class="map-container" id="map-location" style="position: relative; overflow: hidden;">--}}
        {{--<div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">--}}
            {{--<div class="gm-err-container">--}}
                {{--<div class="gm-err-content">--}}
                    {{--<div class="gm-err-icon"><img src="https://maps.gstatic.com/mapfiles/api-3/images/icon_error.png"--}}
                                                  {{--draggable="false" style="user-select: none;"></div>--}}
                    {{--<div class="gm-err-title">Oops! Something went wrong.</div>--}}
                    {{--<div class="gm-err-message">This page didn't load Google Maps correctly. See the JavaScript console--}}
                        {{--for technical details.--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</section>--}}

{{--  sponsors --}}

@include('site.sponser')