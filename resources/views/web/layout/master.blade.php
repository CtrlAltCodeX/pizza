<!DOCTYPE html>
<html>

<head>
    <title>Gabriel Pizza</title>
    <meta charset="utf-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="John Doe">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/media.css') }}" />
    <!-- <link rel="stylesheet" type="text/css" href="css/all.min.css" /> -->
    <link rel="stylesheet" href="{{ asset('css/owlCarousal.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owlTheme.min.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/apple-touch-icon.png') }}" sizes="16x16" />
    @stack('head')
    @stack('css')
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

    @include('web.layout.header')

    @yield('section')

    @include('web.layout.footer')

    <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/stickybits.min.js') }}"></script>
    <script src="{{ asset('js/owlCarousel.min.js') }}"></script>
    <script src="{{ asset('js/stickybits.min.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    <script>
        stickybits('.main-header', {
            useStickyClasses: true
        });

        $(document).ready(function() {
            $(window).on('load', function() {
                setTimeout(function() {
                    $("#preloader").delay(600).fadeOut(600).addClass('loaded');
                }, 700);
            });

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
        });
    </script>
    
    @stack('js')
</body>

</html>