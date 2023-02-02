<header class="header-area header-three">
    <div class="header-top second-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-10 col-md-10 d-none d-lg-block">
                    <div class="header-cta">
                        <ul>
                            <li>
                                <i class="far fa-clock"></i>
                                <span>{{ $settings?->siteHeaderInfo }}</span>
                            </li>
                            <li>
                                <i class="far fa-mobile"></i>
                                <strong>{{ $settings?->firstPhoneNumber }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 d-none d-lg-block text-right">
                    <div class="header-social">
                        <span>
                            <a target="_blank" href="{{ $settings?->facebookID }}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="{{ $settings?->linkedinID }}" title="LinkedIn"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="{{ $settings?->twitterID }}" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="{{ $settings?->youtubeID }}" title="Twitter"><i class="fab fa-youtube"></i></a>
                       </span>
                        <!--  /social media icon redux -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="/">
                                <img src="{{ $settings?->whiteLogo }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8">

                        <div class="main-menu text-center">
                            <nav id="mobile-menu" style="display: block;">
                                <ul>
                                    <li class="">
                                        <a href="/">Home</a>
                                    </li>
                                    <li><a href="about.html">About</a></li>
                                    <li class="has-sub">
                                        <a href="room.html">our rooms</a>
                                        <ul>
                                            <li> <a href="room.html">Our Rooms</a></li>
                                            <li> <a href="single-rooms.html">Rooms Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-sub">
                                        <a href="services.html">Facilities</a>
                                        <ul>
                                            <li> <a href="services.html">Services</a></li>
                                            <li> <a href="single-service.html">Services Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="blog.html">Blog</a>
                                    </li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                        <a href="contact.html" class="top-btn mt-10 mb-10">reservation </a>
                    </div>

                    <div class="col-12">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
