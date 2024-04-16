<!DOCTYPE html>
<html>

<head>
    <title>Gabriel Pizza</title>
    <meta charset="utf-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" /> -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/media.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owlCarousal.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owlTheme.min.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/apple-touch-icon.png') }}" sizes="16x16" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    @stack('head')
    @stack('css')
    <style>
        header {
            z-index: 1800 !important;
        }
    </style>
</head>

<body>
    <div id="preloader" class="loader-overlay">
        <div class="loading loader loader--centered">
            <div class="loader__icon">
                <img src="{{ asset('images/loader.png') }}" alt="loader" />
            </div>
            <div class="loader__label">Loading products...</div>
            <img src="{{ asset('images/loader-logo.png') }}" alt="logo" />
        </div>
    </div>

    @if(request()->route()->uri == "/")
    @include('web.layout.home-header')
    @else
    @include('web.layout.header')
    @endif

    @yield('section')

    <div class="modal fade cart-model" id="cartModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cart-model-label">
                        <h4>Order Summary</h4>
                        <p>Ordering as <b>guest</b> for <b>Pickup</b> at <b>2150 Robertson Rd</b>
                            Your store opens:<b> March 18 2024, 11:00 am</b></p>
                    </div>

                    @if(session()->get('cart'))
                    <div class="cart-item-wrapper">
                        <div class="row">
                            @php $totalPrice = 0; @endphp
                            @foreach(session()->get('cart') as $key => $item)
                            @php
                            $totalPrice = $totalPrice + $item['total']
                            @endphp
                            <div class="col-sm-9">
                                <div class="cart-item-name">
                                    <img src="{{ $item['image'] }}" width="100" />
                                    <h4 class="mt-2">{{$item['quantity']}}x {{$item['name']}}</h4>
                                    <!-- <span><strong>Selections:</strong>
                                        @foreach($item as $innerKey => $topings)
                                        @if($innerKey == 'thickness' && ($topings && count($topings))) Thickness - ${{ array_sum($topings) }} @endif
                                        @if($innerKey == 'sauce' && ($topings && count($topings))) Sauce - ${{ array_sum($topings) }}@endif
                                        @if($innerKey == 'cheese' && ($topings && count($topings))) Cheese ${{ array_sum($topings) }} @endif
                                        @if($innerKey == 'meat' && ($topings && count($topings))) Meat - ${{ array_sum($topings) }} @endif
                                        @if($innerKey == 'veggies' && ($topings && count($topings))) Veggies - ${{ array_sum($topings) }}@endif
                                        @endforeach
                                    </span> -->
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="price-with-edit-btn text-light">
                                    <span><sup>$</sup>{{ $item['total'] }}</span>
                                    <a id='remove' class="{{ $key }}">X</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="total-data">
                        <div class="st-col"><b>Subtotal</b><span><sup>$</sup>{{ $totalPrice }}</span></div>
                        <div class="order-total">
                            <h4>Order Total</h4>
                            <span><sup>$</sup>{{ $totalPrice }}</span>
                        </div>
                    </div>

                    <div class="cl-btn text-center pc-btn">
                        <a id='payment' class="pro-order-btn" href='{{ route("payment.checkout") }}'>Proceed to checkout</a>
                    </div>

                    @else
                    <div class="cart-model-label">
                        <h4>Cart is Empty</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('web.layout.footer')

    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/stickybits.min.js') }}"></script>
    <!-- <script src="{{ asset('js/owlCarousel.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/stickybits.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/wow.js') }}"></script> -->
    <!-- <script src="{{ asset('js/all.js') }}"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
    <script>
        stickybits('.main-header', {
            useStickyClasses: true
        });

        $(document).ready(function() {
            // $(window).on('load', function() {
            setTimeout(function() {
                $("#preloader").delay(600).fadeOut(600).addClass('loaded');
            }, 700);
            // });

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
            }).owlCarousel({
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

            $("#remove").click(function() {
                var orderId = $(this).attr('class');
                $.ajax({
                    url: '{{route("user.cart.item.remove")}}',
                    type: "GET",
                    data: {
                        item: orderId
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            location.reload();
                        }
                    },
                });
            })
        });
    </script>

    @stack('js')
</body>

</html>