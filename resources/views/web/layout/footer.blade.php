<footer class="footer-section">
    <div class="container">
        <div class="row footer-row">
            <div class="col-md-2">
                <a href="#" class="footer-logo"><img src="{{ asset('images/logo.png') }}" alt="logo" /></a>
            </div>
            <div class="col-md-10">
                <div class="footer-link">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dine-in Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#collapseExample">About Gabes</a>
                            <div class="collapse" id="collapseExample">
                                <ul class="footer-dropdowan">
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li><a href="{{ route('community') }}">Community</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('location') }}">Our Locations</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn--call" href="tel:6136567777" title="Call to order"><span class="highlight">Order Now:</span> (613) 656-7777</a>
                        </li>
                    </ul>
                    <nav class="nav justify-content-end">
                        <a class="nav-link" href="#">Privacy Policy</a>
                        <a class="nav-link" href="#">Terms of Service</a>
                        <a class="nav-link" href="#">Accessibility</a>
                        <a class="nav-link" href="#">Buy Gift Cards & Check Balance</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>