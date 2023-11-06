<footer class="revealed">
    @php
        $site_settings = \App\Models\SiteSetting::find(1);
    @endphp
    <div class="footer_bg">
        <div class="gradient_over"></div>
        <div class="background-image" data-background="url({{ asset($site_settings->footer_background) }})"></div>
    </div>
    <div class="container">
        <div class="row move_content">
            <div class="col-lg-4 col-md-12">
                <h5>Contacts</h5>
                <ul>
                    <li>{{ $site_settings->address }}<br><br></li>
                    <li><strong><a href="mailto:{{ $site_settings->email }}">{{ $site_settings->email }}</a></strong><br><br></li>
                    <li><strong><a href="tel:{{ $site_settings->phone }}">{{ $site_settings->phone }}</a></strong></li>
                </ul>
                <div class="social">
                    <ul>
                        <li><a href="{{ $site_settings->instagram }}"><i class="bi bi-instagram"></i></a></li>
                        <li><a href="{{ $site_settings->whatsapp }}"><i class="bi bi-whatsapp"></i></a></li>
                        <li><a href="{{ $site_settings->facebook }}"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="{{ $site_settings->twitter }}"><i class="bi bi-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 ms-lg-auto">
                <h5>Explore</h5>
                <div class="footer_links">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="room-list-1.html">Rooms &amp; Suites</a></li>
                        <li><a href="news-1.html">News &amp; Events</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="about.html">Terms and Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div id="newsletter">
                    <h5>Newsletter</h5>
                    <div id="message-newsletter"></div>
                    <form method="post" action="phpmailer/newsletter_template_email.php" name="newsletter_form" id="newsletter_form">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                            <button type="submit" id="submit-newsletter"><i class="bi bi-send"></i></button>
                        </div>
                    </form>
                    <p>Receive latest offers and promos without spam. You can cancel anytime.</p>
                </div>
            </div>
        </div>
        <!--/row-->
    </div>
    <!--/container-->
    <div class="copy">
        <div class="container">
            {{ $site_settings->copyright }}
        </div>
    </div>
</footer>