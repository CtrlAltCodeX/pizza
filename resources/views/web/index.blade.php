@extends("web.layout.master")

@section("section")

<section class="hero-slider-section">
    <div id="sync1" class="owl-carousel owl-theme">
        <div class="item">
            <div class="hero-slider-img hero-slider-bg-1">
                <div class="container">
                    <div class="slider-content-wrapper">
                        <span>ONLINE ORDERING</span>
                        <h2>ORDER & PAY ONLINE</h2>
                        <p>Order your favourite Gabriel Pizza online for pick-up or delivery.
                            Bigger, better pizza is just a click or tap away.</p>
                        <a href="javascript:void(0);">Order Online <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="hero-slider-img hero-slider-bg-2">
                <div class="container">
                    <div class="slider-content-wrapper">
                        <span>PURCHASE AND REDEEM ONLINE</span>
                        <h2>GABE'S GIFT CARDS</h2>
                        <p>Gabe's Gift Cards can now be purchased and redeemed online.</p>
                        <a href="javascript:void(0);">Purchase a Gift Card <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="hero-slider-img hero-slider-bg-3">
                <div class="container">
                    <div class="slider-content-wrapper">
                        <span>THE OFFICIAL</span>
                        <h2>OTTAWA SENATORS PIZZA</h2>
                        <p>Gabe's Gift Cards can now be purchased and redeemed online.</p>
                        <a href="javascript:void(0);">Order Online Now <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="hero-slider-img hero-slider-bg-4">
                <div class="container">
                    <div class="slider-content-wrapper">
                        <span>902-604-0386</span>
                        <h2>GABE'S ANTIGONISH</h2>
                        <p>Join us for breakfast, lunch and dinner 7 days a week. Order online for pick-up and delivery. Bigger, better pizza has arrived in the Maritimes.</p>
                        <a href="javascript:void(0);"> Grab Deal <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="sync2" class="owl-carousel owl-theme">
        <div class="item">
            <div class="nav-carousel-slider nv-slidr-1">
                <div class="owl-content">
                    <span>Online Ordering</span>
                    <h2>Order & Pay Online</h2>
                    <b>1</b>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="nav-carousel-slider nv-slidr-2">
                <div class="owl-content">
                    <span>Purchase and redeem ONLINE</span>
                    <h2>GABE'S GIFT CARDS</h2>
                    <b>2</b>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="nav-carousel-slider nv-slidr-3">
                <div class="owl-content">
                    <span>The Official</span>
                    <h2>OTTAWA SENATORS Pizza</h2>
                    <b>3</b>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="nav-carousel-slider nv-slidr-4">
                <div class="owl-content">
                    <span>902-604-0386</span>
                    <h2>Gabe's antigonish</h2>
                    <b>4</b>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="your-pizza-section">
    <div class="container">
        <div class="row your-pizza-row">
            <div class="col-xl-5">
                <div class="module-menu__details">
                    <div class="module-pizza-zas">
                        <span><a style="color:#FFFFFF; text-decoration:none" href="">Pizza</a> Your</span>
                        <h2 class="module-menu__title">Zas Off</h2>
                    </div>
                    <div class="module-menu__cta">
                        <div class="module-menu__cta-interior">
                            <p>Feelin' <span class="distinct">Hungry?</span></p>
                            <a href="{{ route('user.order.index', 'pizzas') }}" class="c-btn">Order Now <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="module-menu__items_label">
                    <h3>Featured <span class="distinct">'Zas</span></h3>
                </div>
                <div class="row">
                    @foreach($items as $item)
                    <div class="col-md-4">
                        <div class="product-wrapper">
                            <img src="/public/admin/images/items/{{$item->img}}" alt="product-pizza" />
                            <div class="product-title-wrapper">
                                <div class="product-title-with-btn">
                                    <h4 class="module-menu__item-name">{{$item->name}}</h4>
                                    <div class="module-menu__item-price">from {{explode(',',$item->price)[0]}}</div>
                                </div>
                                <div class="pizza-order-btn">
                                    <a href="{{ route('user.order.index', 'pizzas') }}" class="c-btn">Build Pizza</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="module-bg-img">
        <img src="images/SmithWhitton.png" alt="smith pizza" />
    </div>
</section>

<section class="dont-za-section">
    <div class="container">
        <div class="row dont-za-row">
            <div class="col-xl-6">
                <div class="recommanded-product">
                    <h3>WE ALSO <span>RECOMMEND</span></h3>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <img src="{{ asset('images/sand-1.png') }}" alt="sand-1.png" />
                                <div class="product-title-wrapper">
                                    <div class="product-title-with-btn">
                                        <h4 class="module-menu__item-name">Sandwiches</h4>
                                    </div>
                                    <div class="pizza-order-btn">
                                        <a href="" class="c-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <img src="images/hot-dog-1.png" alt="hot-dog-1" />
                                <div class="product-title-wrapper">
                                    <div class="product-title-with-btn">
                                        <h4 class="module-menu__item-name">Baked Subs</h4>
                                    </div>
                                    <div class="pizza-order-btn">
                                        <a href="" class="c-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <img src="images/manchu.png" alt="manchu" />
                                <div class="product-title-wrapper">
                                    <div class="product-title-with-btn">
                                        <h4 class="module-menu__item-name">PASTAS</h4>
                                    </div>
                                    <div class="pizza-order-btn">
                                        <a href="" class="c-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <img src="images/SALad.png" alt="manchu" />
                                <div class="product-title-wrapper">
                                    <div class="product-title-with-btn">
                                        <h4 class="module-menu__item-name">SALAD</h4>
                                    </div>
                                    <div class="pizza-order-btn">
                                        <a href="" class="c-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <img src="images/starter.png" alt="starter.png" />
                                <div class="product-title-wrapper">
                                    <div class="product-title-with-btn">
                                        <h4 class="module-menu__item-name">Starters</h4>
                                    </div>
                                    <div class="pizza-order-btn">
                                        <a href="" class="c-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-wrapper">
                                <img src="images/chicken.png" alt="chicken.png" />
                                <div class="product-title-wrapper">
                                    <div class="product-title-with-btn">
                                        <h4 class="module-menu__item-name">CHICKEN</h4>
                                    </div>
                                    <div class="pizza-order-btn">
                                        <a href="" class="c-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="dont-za-pizza-flex">
                    <div class="more-pizza-content">
                        <h4>MORE THAN JUST <b>PIZZA</b></h4>
                        <p>You can't eat pizza every day. Gabe's offers a full Italian inspired menu featuring salad, pasta, burgers, wings and so much more.</p>
                    </div>
                    <div class="dont-za-label">
                        <h2>DON'T WANT <span>ZA?</span></h2>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="mobile-section">
    <div class="ofc-btn-group">
        <a href="javascript:void(0)">order now!</a>
        <a href="javascript:void(0)">Find a Gabe's</a>
        <a href="javascript:void(0)">Contact Us</a>
    </div>
</section>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        var sync1 = $("#sync1");
        var sync2 = $("#sync2");
        var slidesPerPage = 4; //globaly define number of elements per page
        var syncedSecondary = true;

        sync1.owlCarousel({
            items: 1,
            slideSpeed: 500000,
            nav: false,
            autoplay: true,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            animateOut: 'fadeOut',
            mouseDrag: false,
            touchDrag: false,
        }).on('changed.owl.carousel', syncPosition);

        sync2.on('initialized.owl.carousel', function() {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: slidesPerPage,
                dots: false,
                nav: false,
                smartSpeed: 5000,
                slideSpeed: 5000,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate: 100,
                mouseDrag: false,
                touchDrag: false,
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if you set loop to false, you have to restore this next line
            //var current = el.item.index;

            //if you disable loop you have to comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }

            //end block
            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
    })
</script>

@endpush