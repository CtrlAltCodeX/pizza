<header class="main-header navbar-fixed-top ">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="order-link">
                <a href="{{ url('/order', ['slug' => 'pizzas']) }}">Order online</a>
            </div>

            <div class="navbar-logo">
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('images/logo.png')}}" alt="logo" />
                </a>
            </div>

            <div class="navbar-call-btn">
                <ul class="nav nav--secondary">
                    <li>
                        <a class="btn btn--call" href="tel:6136567777" title="Call to Order">
                            <span class="highlight">Order Now:</span>
                            (613) 656-7777</a>
                    </li>
                    <li><a class="btn btn--language" href="">FR</a></li>
                    @if(auth()->check())
                    <li><a class="btn btn--language" href="{{ route('user.log.out') }}">Logout</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>