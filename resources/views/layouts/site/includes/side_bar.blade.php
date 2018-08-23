<!--Sidebar Navigation-->
<aside id="side-navigation">
    <button type="button" class="toggle-nav"><span class="fa fa-bars"></span></button>

    <div class="sidebar-inner">
        <!--Logo-->
        <div class="logo"><a href="#"><img src="{{ asset(\App\Models\SiteConfig::getValueByKey('logo')) }}" alt=""></a></div>

        <!--Main Navigation-->
        <nav class="navigation">
            <ul>
                <li class="current dropdown"><a href="index.html">Home</a>
                    <ul class="submenu">
                        <li><a href="index.html">Homepage Style One</a></li>
                        <li><a href="index-2.html">Homepage Style Two</a></li>
                        <li><a href="index-3.html">Homepage Style Three</a></li>
                        <li><a href="index-4.html">Fullscreen Video Background</a></li>
                        <li><a href="index-5.html">Fullscreen Parallax</a></li>
                        <li><a href="index-6.html">Fullscreen Static Image</a></li>

                    </ul>
                </li>
                <li class="dropdown"><a href="#">Pages</a>
                    <ul class="submenu">
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="features.html">Features</a></li>
                        <li><a href="our-services.html">Sevices</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li class="dropdown">
                            <a href="testimonial-v1.html">Testimonials</a>
                            <ul class="submenu">
                                <li><a href="testimonial-v1.html">Testimonial V1</a></li>
                                <li><a href="testimonial-v2.html">Testimonial V2</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="gallery.html">Gallery</a>
                            <ul class="submenu">
                                <li><a href="gallery.html">Gallery Style One</a></li>
                                <li><a href="gallery-2.html">Gallery Style Two</a></li>
                                <li><a href="gallery-3.html">Gallery Style Three</a></li>
                                <li><a href="gallery-4.html">Gallery Style Four</a></li>
                                <li><a href="gallery-5.html">Gallery Style Five</a></li>
                            </ul>
                        </li>
                        <li><a href="donation.html">Donation</a></li>
                        <li><a href="become-a-volunteer.html">Become a Volunteer</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="causes.html">Causes</a>
                    <ul class="submenu">
                        <li><a href="single-causes.html">Single Causes</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="event.html">Event</a>
                    <ul class="submenu">
                        <li><a href="single-event.html">Single Event</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="blog.html">Blog</a>
                    <ul class="submenu">
                        <li><a href="blog.html">Blog Page</a></li>
                        <li><a href="blog-detail.html">Blog Detail Page</a></li>
                        <li class="dropdown"><a href="left-sidebar.html">Sidebar Pages</a>
                            <ul class="submenu from-left">
                                <li><a href="left-sidebar.html">Left Sidebar Page</a></li>
                                <li><a href="right-sidebar.html">Right Sidebar Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a href="contact.html">Contact</a>
                    <ul class="submenu from-left">
                        <li><a href="contact.html">Contact Style One</a></li>
                        <li><a href="contact-2.html">Contact Style Two</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!--Sidebar Nav End-->