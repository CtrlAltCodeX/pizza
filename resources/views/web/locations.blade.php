@extends("web.layout.master")

@push('css')
<link rel='stylesheet' href='https://gabrielpizza.com/wp-content/themes/gabriel-theme/style.css' />

<style id='wpml-legacy-horizontal-list-0-inline-css' type='text/css'>
    body {
        padding: 0px !important;
    }

    .order-call-nav {
        display: flex;
    }

    .container {
        padding: 0px !important;
    }
</style>
@endpush

@section("section")
<main role="main" id="main" class="main main--locations">
    <div class="wrapper">
        <div class="grid">
            <div class="grid__item lap-1-2">
                <h1 class="pagetitle">Locations<div class="subtitle">Gabriel Pizza</div>
                </h1>
            </div>
            <div class="grid__item lap-1-2">
            </div>
        </div>
    </div>
</main>
<div class="legend-wrapper">
    <ul class="map-legend" id="legend">
        <li class="map-legend__item map-legend__item--delivery">Takeout & Delivery</li>
        <li class="map-legend__item map-legend__item--dinein-only">Eat-In Restaurant Only</li>
        <li class="map-legend__item map-legend__item--dinein">Takeout, Delivery & Eat-In Restaurant</li>
    </ul>
</div>
<div class="map-wrapper">
    <div id="map" class="map"></div>
</div>
@endsection