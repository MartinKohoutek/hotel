<header class="fixed_header menu_v4 submenu_version">
    <div class="layer"></div><!-- Opacity Mask -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-3">
                <a href="{{ url('/') }}" class="logo_normal"><img src="{{ asset('frontend/img/logo.png') }}" width="135" height="45" alt=""></a>
                <a href="{{ url('/') }}" class="logo_sticky"><img src="{{ asset('frontend/img/logo_sticky.png') }}" width="135" height="45" alt=""></a>
            </div>
            <div class="col-9">
                <div class="main-menu">
                    <a href="#" class="closebt open_close_menu"><i class="bi bi-x"></i></a>
                    <div class="logo_panel"><img src="{{ asset('frontend/img/logo_sticky.png    ') }}" width="135" height="45" alt=""></div>
                    <nav id="mainNav">
                        <ul>
                            <li class="submenu">
                                <a href="#0" class="show-submenu">Home</a>
                                <ul>
                                    <li><a href="index.html">Home Video Bg</a></li>
                                    <li><a href="index-2.html">Home Carousel</a></li>
                                    <li><a href="index-3.html">Home FlexSlider</a></li>
                                    <li><a href="index-4.html">Home Youtube/Vimeo</a></li>
                                    <li><a href="index-5.html">Home Parallax</a></li>
                                    <li><a href="index-6.html">Home Parallax 2</a></li>
                                    <li><a href="index-7.html">Home Working Booking</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#0" class="show-submenu">Rooms & Suites</a>
                                <ul>
                                    <li><a href="room-list-1.html">Room list 1</a></li>
                                    <li><a href="room-list-2.html">Room list 2</a></li>
                                    <li><a href="room-list-3.html">Room list 3</a></li>
                                    <li><a href="room-details.html">Room details</a></li>
                                    <li><a href="room-details-booking.html">Working Booking Request</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="#0" class="show-submenu">Other Pages</a>
                                <ul>
                                    <li><a href="gallery.html">Masonry Gallery</a></li>
                                    <li><a href="restaurant.html">Restaurant</a></li>
                                    <li><a href="menu-of-the-day.html">Menu of the day</a></li>
                                    <li><a href="news-1.html">Blog</a></li>
                                    <li><a href="404.html">Error Page</a></li>
                                    <li><a href="modal-advertise-1.html">Modal Advertise</a></li>
                                    <li><a href="cookie-bar.html">GDPR Cookie Bar</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                    <li><a href="menu-2.html">Menu Version 2 <span class="custom_badge">Hot</span></a></li>
                                    <li><a href="menu-3.html">Menu Version 3</a></li>
                                    <li><a href="menu-4.html">Menu Version 4</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            @auth
                            <li><a href="{{ route('dashboard') }}"><i class='bx bx-user'></i>Dashboard</a></li>
                            <li><a href="{{ route('user.logout') }}"><i class='bx bx-user'></i>Logout</a></li>
                            @else
                            <li><a href="{{ route('login') }}"><i class='bx bx-user'></i>Login</a></li>
                            <li><a href="{{ route('register') }}"><i class='bx bx-user'></i>Register</a></li>
                            @endauth
                            <li><a href="#booking_section" class="btn_1">Book Now</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="hamburger_2 open_close_menu float-end">
                    <div class="hamburger__box">
                        <div class="hamburger__inner"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- container -->
</header><!-- End Header -->