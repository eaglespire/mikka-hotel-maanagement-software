<footer class="footer-bg footer-p">
    <div class="footer-top  pt-90 pb-40" style="background-color: #644222; background-image: url({{ asset('front/img/bg/footer-bg.png') }});">
        <div class="container">
            <div class="row justify-content-between">


                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title mb-30">
                            <img src="{{ $settings?->whiteLogo }}" alt="img">
                        </div>
                        <div class="f-contact">
                            <ul>
                                @if(!empty($settings?->firstPhoneNumber))
                                    <li>
                                        <i class="icon fal fa-phone"></i>
                                        <span>{{ $settings?->firstPhoneNumber }}
                                            @if(!empty($settings?->secondPhoneNumber))
                                                <br>{{ $settings?->secondPhoneNumber }}
                                            @endif
                                    </span>
                                    </li>
                                @endif

                                @if(!empty($settings?->firstEmail))
                                    <li><i class="icon fal fa-envelope"></i>
                                        <span>
                                            <a target="_blank" href="mailto:{{ $settings?->firstEmail }}">{{ $settings?->firstEmail }}</a>
                                           <br>
                                           <a target="_blank" href="mailto:{{ $settings?->secondEmail }}">{{ $settings?->secondEmail }}</a>
                                       </span>
                                    </li>
                                @endif

                                @if(!empty($settings?->firstAddress))
                                    <li>
                                        <i class="icon fal fa-map-marker-check"></i>
                                        <span>{{ $settings?->firstAddress }}<br> {{ $settings?->secondAddress }}</span>
                                    </li>
                                @endif
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Our Links</h2>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li><a href="about.html"> About Us</a></li>
                                <li><a href="services.html"> Services </a></li>
                                <li><a href="contact.html"> Contact Us</a></li>
                                <li><a href="blog.html">Blog </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Our Services</h2>
                        </div>
                        <div class="footer-link">
                            <ul>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Privercy</a></li>
                                <li><a href="#">Term & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6">
                    <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                            <h2>Subscribe To Our Newsletter</h2>
                        </div>
                        <div class="footer-link">
                            <p>Subscribe our newsletter to get our latest update &amp; News</p>
                            <div class="subricbe p-relative" data-animation="fadeInDown" data-delay=".4s">
                                <form action="" method="post" class="contact-form ">
                                    <input type="text" id="email2" name="email2" class="header-input" placeholder="Your Email..." required>
                                    <button class="btn header-btn"><i class="fas fa-location-arrow"></i></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    Copyright &copy; {{ $settings?->siteName }} 2023 . All rights reserved.
                </div>
                <div class="col-lg-6 col-md-6 text-right text-xl-right">
                    <div class="footer-social">
                        <a target="_blank" href="{{ $settings?->facebookID }}"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="{{ $settings?->twitterID }}"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" href="{{ $settings?->instagramID }}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
