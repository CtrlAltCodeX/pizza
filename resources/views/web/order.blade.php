@extends("web.layout.master")

@push('head')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/media.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.cdnfonts.com/css/proxima-nova-condensed" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('images/apple-touch-icon.png') }}" sizes="16x16" />
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
@endpush

@php
$urlParts = explode('/', url()->current());
$lastPart = last($urlParts);

@endphp

@section('section')

<section class="order-tab-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="order-mood-label">
                    <h3>What are you in the mood for?</h3>
                </div>
            </div>
            <div class="col-md-8">
                <div class="deal-label">
                    <h2>Starters</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="nav flex-column nav-pills nav-p-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($categories as $category)
                    <a class="nav-link " id="v-pills-pizzas-tab" href="{{ route('user.order.index', ['slug' => $category->slug]) }}" >
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="23" height="23" x="0" y="0" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512 512" xml:space="preserve">
                            <g>
                                <path d="M509.026 2.885A9.995 9.995 0 0 0 498.642.583L83.289 148.68c-14.43-8.824-32.733-10.89-49.52-3.939-27.865 11.543-41.146 43.604-29.604 71.471 27.219 65.708 66.518 124.525 116.809 174.816s109.107 89.591 174.816 116.809a54.41 54.41 0 0 0 20.861 4.164c21.475-.001 41.894-12.726 50.609-33.769 5.864-14.158 5.31-29.396-.299-42.48L511.462 13.238a10.002 10.002 0 0 0-2.436-10.353zM146.179 147.489l44.02-15.694a25.442 25.442 0 0 1 6.678 20.752c-.89 6.75-4.354 12.751-9.755 16.896-5.401 4.145-12.089 5.936-18.844 5.049-6.749-.889-12.749-4.352-16.894-9.754-3.819-4.977-5.636-11.049-5.205-17.249zm202.603 323.088c-7.322 17.678-27.664 26.103-45.338 18.779-128.04-53.035-227.763-152.759-280.8-280.799-3.547-8.563-3.547-17.994 0-26.558 3.547-8.563 10.216-15.232 18.779-18.779s17.995-3.547 26.558 0 15.232 10.216 18.779 18.779c22.701 54.807 55.481 103.865 97.429 145.813 41.948 41.948 91.006 74.727 145.813 97.429 17.678 7.321 26.103 27.66 18.78 45.336zm88.843-303.248a25.786 25.786 0 0 1-2.715-.192c-6.749-.889-12.749-4.353-16.893-9.754-4.145-5.401-5.938-12.094-5.05-18.843 1.835-13.934 14.66-23.776 28.599-21.944 4.3.566 8.337 2.234 11.78 4.771l-15.721 45.962zm22.368-65.406a45.478 45.478 0 0 0-15.817-5.156c-24.871-3.283-47.764 14.294-51.038 39.163-1.586 12.046 1.614 23.989 9.011 33.629 7.125 9.285 17.325 15.351 28.831 17.201l-19.876 58.119-22.858-17.54c-4.381-3.36-10.66-2.536-14.021 1.846-3.362 4.382-2.535 10.659 1.846 14.021l28.205 21.642-51.694 151.155a54.475 54.475 0 0 0-14.922-9.241c-105.98-43.899-188.52-126.439-232.417-232.417a54.66 54.66 0 0 0-5.609-10.26l26.779-9.548c.935 8.068 4.032 15.764 9.105 22.375 7.396 9.64 18.105 15.822 30.151 17.407 2.018.266 4.03.398 6.032.398 9.948 0 19.572-3.25 27.597-9.407 9.641-7.398 15.822-18.105 17.409-30.153a45.412 45.412 0 0 0-6.768-30.401l124.307-44.322 4.711 11.374a10.005 10.005 0 0 0 9.243 6.176 9.98 9.98 0 0 0 3.823-.764c5.102-2.113 7.525-7.964 5.412-13.066l-4.326-10.445 132.719-47.322-25.835 75.536z" opacity="1"></path>
                                <path d="M108 268.276c-.03-.047-.113-.174-.145-.22-3.062-4.593-9.259-5.826-13.854-2.767-4.587 3.054-5.831 9.253-2.795 13.848a9.995 9.995 0 0 0 13.789 2.958c4.646-2.987 5.991-9.174 3.005-13.819zM92.791 243.433a473.307 473.307 0 0 1-26.036-53.147c-2.113-5.104-7.966-7.524-13.065-5.411-5.103 2.113-7.525 7.963-5.411 13.065a493.223 493.223 0 0 0 27.14 55.401 9.997 9.997 0 0 0 13.64 3.733c4.797-2.737 6.469-8.844 3.732-13.641zM312.933 127.987a45.819 45.819 0 0 0-5.983-.394c-22.717 0-42.087 17.005-45.055 39.555-3.274 24.868 14.293 47.764 39.161 51.038 1.982.262 3.995.394 5.983.394 22.716 0 42.086-17.005 45.055-39.557 3.273-24.867-14.294-47.762-39.161-51.036zm19.333 48.426c-1.664 12.637-12.509 22.166-25.227 22.166-1.118 0-2.253-.074-3.372-.222-13.935-1.835-23.777-14.664-21.943-28.599 1.664-12.636 12.508-22.164 25.226-22.164 1.118 0 2.253.074 3.372.222 13.934 1.836 23.778 14.664 21.944 28.597zM310.331 252.374a45.83 45.83 0 0 0-5.983-.394c-22.717 0-42.087 17.005-45.055 39.556-1.587 12.047 1.613 23.989 9.01 33.63 7.396 9.64 18.104 15.822 30.151 17.409 1.981.261 3.993.392 5.98.392 22.717 0 42.088-17.005 45.057-39.557 3.275-24.866-14.293-47.76-39.16-51.036zm19.333 48.427c-1.664 12.637-12.51 22.166-25.228 22.166a25.96 25.96 0 0 1-3.37-.222c-6.75-.89-12.75-4.354-16.895-9.755-4.145-5.401-5.938-12.093-5.049-18.844 1.664-12.636 12.509-22.165 25.226-22.165 1.118 0 2.253.074 3.372.222 13.933 1.835 23.777 14.664 21.944 28.598zM244.375 210.946l-30.736-4.047c-5.473-.727-10.499 3.133-11.22 8.608-.722 5.476 3.133 10.499 8.608 11.22l30.736 4.047c.443.059.883.087 1.318.087 4.941 0 9.239-3.663 9.901-8.695.723-5.475-3.131-10.499-8.607-11.22zM228.79 284.743l-2.714-20.624c-.721-5.476-5.743-9.332-11.219-8.609-5.476.721-9.33 5.743-8.609 11.219l2.715 20.624c.662 5.033 4.959 8.696 9.901 8.696.435 0 .875-.028 1.317-.087 5.476-.721 9.33-5.743 8.609-11.219z" opacity="1"></path>
                            </g>
                        </svg>
                        {{$category->name}}
                    </a>
                    @endforeach
                </div>

                <div class="select-store-dropdown">
                    <label>Select a store...</label>
                    <select class="selectpicker">
                        <option>Antigonish - 48 Nova Landing (closed)</option>
                        <option>Ketchup</option>
                        <option>Barbecue</option>
                        <option>Mustard</option>
                        <option>Ketchup12</option>
                    </select>
                </div>
            </div>

            <div class="col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="deal-comman-header">
                        <p>Due to an update with our map provider, some addresses are no longer working with the city name ROCKLAND. Please try using CLARENCE CREEK as your city.</p>
                    </div>

                    <div class="tab-pane fade show active" id="v-pills-deal" role="tabpanel">
                        <div class="row">
                            <div class="product-col">
                                <div class="product-bg-wrapper pro-bg-image">
                                    <div class="image-with-content ">
                                        <div class="pro-con">
                                            <h4>CREATE YOUR OWN</h4>
                                            <h3> CUSTOM PIZZA</h3>
                                            <a class="pro-order-btn checkSession" data-toggle="modal" data-target="#exampleModalLong2">
                                                Start your order
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach($pizza as $key => $piz)
                            <div class="product-col">
                                <div class="product-bg-wrapper">
                                    <p class="price">
                                        <i class="price__subtext">Starting at</i>
                                        <span><sup>$</sup>{{ $piz['price'][0] }}</span>
                                    </p>
                                    <div class="image-with-content">
                                        <div class="product-image">
                                            <img src="{{ asset('admin/images/items') ."/". $piz['img'] }}" alt="product-1" />
                                        </div>
                                        <div class="pro-con">
                                            <h4>{{ $piz['name'] }}</h4>
                                            <h3> {{ $piz['calories'] }} Cals/slice</h3>
                                            <div class="pro-btn-with-description">
                                                <p>{{ implode(', ', $piz['all']) }}</p>
                                            </div>
                                            <a href="#" class="pro-order-btn checkSession" data-key={{$key}} data-toggle="modal" data-id="{{ $piz['id'] }}" data-target="#exampleModalLong2"> Order </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="order-footer">
                    <div class="media">
                        <img src="{{ asset('images/pizza-icon.png')}}" alt="pizza-icon" />
                        <div class="media-body">
                            <p>Adults and youth (ages 13 and older) need an average of 2,000 calories a day, and children (ages 4 to 12) need an average of 1,500 calories a day. However, individual needs vary.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ----- ORDER Model ---- -->
@if($lastPart == 'pizzas' )
<div class="modal fade custom-order-model" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="custom-order-header-content-wrapper">
                            <h3>CREATE YOUR OWN</h3>
                            <h2 id="nameOfPizza"></h2>
                            <img src="{{ asset('images/cp-pizza.png')}}" alt="pizza" class="w-100 img-fluid" />
                            <div class="cop-price-with-btn">
                                <p>
                                    <sup>$</sup>
                                    <span id="finalPrice" data-finalPrice="0" data-original=0>0</span>
                                </p>
                                <div class="qty-container">
                                    <button class="qty-btn-minus btn-light" type="button">-</button>
                                    <input type="text" name="qty" id="quantity" value="1" class="input-qty" />
                                    <button class="qty-btn-plus btn-light" type="button">+</button>
                                </div>
                                <a href="" class="pro-order-btn" id="orderBTN">Add to order</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="cop-tab-right-part">
                            <ul class="nav nav-pills mb-3 dp-form cop-tab" id="pills-tab-order" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-toggle="pill" data-target="#pills-Size" type="button" role="tab" aria-controls="pills-Size" aria-selected="true">Size & Crust</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-toggle="pill" data-target="#pills-Sauce" type="button" role="tab" aria-controls="pills-Sauce" aria-selected="false">Sauce & Cheese</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-toggle="pill" data-target="#pills-meat" type="button" role="tab" aria-controls="pills-meat" aria-selected="false">Meat</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-toggle="pill" data-target="#pills-Veggiee" type="button" role="tab" aria-controls="pills-Veggiee" aria-selected="false">Veggiee</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-toggle="pill" data-target="#pills-Extras" type="button" role="tab" aria-controls="pills-Extras" aria-selected="false">Extras</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-Size" role="tabpanel" aria-labelledby="pills-Size-tab">
                                    <div class="make-sure-box">Make sure to select a size, crust, and thickness!</div>
                                    <h4 class="pizza-label-h4">Pizza Size, Crust & Thickness</h4>

                                    <div class="">
                                        <div class="row size-flex">
                                            <div class="col-size-label">
                                                <label>Size</label>
                                                <i>Choose from 9" small to 18" extra large.</i>
                                            </div>
                                            <div class="col-size-box">
                                                <div class="">
                                                    <select class="province" id="size" name="size">
                                                        <option value=0>--Select--</option>
                                                        <option value=1>Small (9'')</option>
                                                        <option value=2>Medium(12'')</option>
                                                        <option value=3>Large(15'')</option>
                                                        <option value=4>Extra-Large(18'')</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row size-flex">
                                            <div class="col-size-label">
                                                <label>Crust Type</label>
                                                <i>Gluten free crust available on medium size only.</i>
                                            </div>
                                            <div class="col-size-box">
                                                <div class="mdl-textfield del-select-box">
                                                    <select class="province" name="crust" id="crust">
                                                        <option>Standard Crust</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row size-flex">
                                            <div class="col-size-label">
                                                <label>Crust Thickness</label>
                                            </div>
                                            <div class="col-size-box">
                                                <div class="mdl-textfield del-select-box">
                                                    <select class="province" name="thickness" id="thickness">
                                                        <option value=0>--Select--</option>
                                                        <option value=1>Reguler</option>
                                                        <option value=2>Thick</option>
                                                        <option value=3>Thin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-submit mt-5">
                                                <a class="pro-order-btn cop-border-btn" id="base&cheese"> Base Sauce & Cheese</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-Sauce" role="tabpanel">
                                    <h4 class="pizza-label-h4">Base Sauce & Cheese</h4>
                                    <div class="">
                                        <div class="row size-flex">
                                            <div class="col-size-label">
                                                <label>Sauce</label>
                                                <i>Choose your sauce.</i>
                                            </div>
                                            <div class="col-size-box">
                                                <div class="mdl-textfield del-select-box">
                                                    <select class="province" name="sauce[]">
                                                        @foreach($all['sauce'] as $sauce)
                                                        <option value="{{ $sauce['price'] }}">{{ $sauce['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row size-flex">
                                            <div class="col-size-label">
                                                <label>Cheese</label>
                                                <i>Choose your cheese.</i>
                                            </div>
                                            <div class="col-size-box">
                                                <div class="mdl-textfield del-select-box">
                                                    <select class="province" name="cheese[]">
                                                        @foreach(array_slice($all['cheese'], 2) as $cheese)
                                                        <option value="{{ $cheese['price'] }}">{{ $cheese['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="pizza-label-h4">Add some extra cheese to your pizza</h4>

                                        <div class="row cf-row">
                                            @foreach($all['cheese'] as $key => $cheese)
                                            @if($key < 2) <div class="col-md-6">
                                                <div class="custom-features-section">
                                                    <input type="checkbox" class="ingredients" data-price="{{ $cheese['price'] }}" name="cheese-extra[]" />
                                                    <div class="custom-feat-wrapper">
                                                        <img src="{{ asset('' . $cheese['img'])}}" />
                                                        <span>{{ $cheese['name'] }}</span>
                                                        <img src="{{ asset('images/checked.png')}}" class="checked-img" />
                                                    </div>

                                                    <div class="cop-select-with-radio">
                                                        <div class="cop-sox">
                                                            <select class="province">
                                                                <option>Reguler (1x)</option>
                                                            </select>
                                                        </div>
                                                        <div class="pizza-size-box">
                                                            <div class="second-radio">
                                                                <input type="radio" id="" name="" checked>
                                                                <label for=""></label>
                                                                <span>Full</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                        </div>
                                        @else
                                        @break
                                        @endif
                                        @endforeach
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-submit mt-5">
                                            <button class="pro-order-btn cop-border-btn"> Now Let's add some meat</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-meat" role="tabpanel">

                                <h4 class="pizza-label-h4">Add some meat to your pizza</h4>
                                <div class="row cf-row">
                                    @foreach($all['meat'] as $meat)
                                    <div class="col-md-6">
                                        <div class="custom-features-section meat_ingredients">
                                            <input type="checkbox" name="meat[]" class="ingredients" data-price="{{ $meat['price'] }}" data-meat="{{ $meat['id'] }}" />
                                            <div class="custom-feat-wrapper">
                                                <img src="{{ asset('') . $meat['img']}}" />
                                                <span>{{ $meat['name'] }}</span>
                                                <img src="{{ asset('images/checked.png')}}" class="checked-img" />
                                            </div>

                                            <div class="cop-select-with-radio">
                                                <div class="cop-sox">
                                                    <select class="province" name="meatPortion">
                                                        <option>Easy (.5x)</option>
                                                        <option selected>Reguler (1x)</option>
                                                    </select>
                                                </div>
                                                <div class="pizza-size-box">
                                                    <div class="second-radio">
                                                        <input type="radio" id="" name="" checked>
                                                        <label for=""></label>
                                                        <span>Full</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="col-md-12">
                                    <div class="form-submit mt-5">
                                        <button class="pro-order-btn cop-border-btn"> How about some veggies?</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-Veggiee" role="tabpanel">
                                <h4 class="pizza-label-h4">Add some veggies to your pizza </h4>
                                <div class="row cf-row">
                                    @foreach($all['veggies'] as $veg)
                                    <div class="col-md-6">
                                        <div class="custom-features-section veggies_ingredient">
                                            <input type="checkbox" name="veggies[]" class="ingredients" data-price="{{ $veg['price'] }}" data-veggies="{{ $veg['id'] }}" />
                                            <div class="custom-feat-wrapper">
                                                <img src="{{ asset('') . $veg['img']}}" />
                                                <span>{{ isset($veg['name']) ? $veg['name'] : '' }}</span>
                                                <img src="{{ asset('images/checked.png')}}" class="checked-img" />
                                            </div>

                                            <div class="cop-select-with-radio">
                                                <div class="cop-sox">
                                                    <select class="province" name="veggiesPortion">
                                                        <option>Easy (.5x)</option>
                                                        <option selected>Reguler (1x)</option>
                                                    </select>
                                                </div>
                                                <div class="pizza-size-box">
                                                    <div class="second-radio">
                                                        <input type="radio" id="" name="" checked>
                                                        <label for=""></label>
                                                        <span>Full</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="col-md-12">
                                    <div class="form-submit mt-5">
                                        <button class="pro-order-btn cop-border-btn">And some free extras?</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-Extras" role="tabpanel">
                                <h4 class="pizza-label-h4">Add some free toppings </h4>
                                <div class="row cf-row">
                                    @foreach($all['extra-sauce'] as $extraSauce)
                                    <div class="col-md-6">
                                        <div class="custom-features-section extraSauce_ingredient">
                                            <input type="checkbox" name="extraSauce[]" class="ingredients" data-price="0" data-sauce="{{ $extraSauce['id'] }}" />
                                            <div class="custom-feat-wrapper">
                                                <img src="{{ asset('') . $extraSauce['img']}}" />
                                                <span>{{ isset($extraSauce['name']) ? $extraSauce['name'] : '' }}</span>
                                                <img src="{{ asset('images/checked.png')}}" class="checked-img" />
                                            </div>

                                            <div class="cop-select-with-radio">
                                                <div class="cop-sox">
                                                    <select class="province">
                                                        <option checked>Reguler (1x)</option>
                                                    </select>
                                                </div>
                                                <div class="pizza-size-box">
                                                    <div class="second-radio">
                                                        <input type="radio" id="" name="" checked>
                                                        <label for=""></label>
                                                        <span>Full</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif

<!-- ----- Order setup Modal ---- -->
<div class="modal fade" id="orderSetup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="order-header-content-wrapper">
                    <h2>ORDER SETUP</h2>
                    @guest
                    <div class="ls-btn-group">
                        <button class="pro-order-btn" data-toggle="modal" data-target="#login" data-dismiss="modal"> Log in </button>
                        <button class="pro-order-btn btn-transparent" data-toggle="modal" data-target="#register" data-dismiss="modal"> Sign up</button>
                    </div>
                    <p>Eat pizza. Get points. Get free pizza. Repeat. It's the pizza cycle of life. Become a Pizza Perks member and start earning today.</p>
                    <img src="{{ asset('images/perks.png') }}" alt="perks" />
                    <p>To continue as a <b> guest </b> select delivery or pickup and provide us some details to get you started!</p>
                    @endguest

                    @auth
                    <img src="{{ asset('images/perks.png') }}" alt="perks" />
                    <p>Select delivery or pickup and provide us some details to get you started!</p>
                    @endauth
                </div>
                <ul class="nav nav-pills mb-3 dp-form" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Delivery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Pickup</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="delivery-form-content">
                            <form id="deliveryForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="name">
                                            <label class="mdl-textfield__label">Name<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="email" name="email">
                                            <label class="mdl-textfield__label">Email<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="number" name="phone">
                                            <label class="mdl-textfield__label">Phone # <span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="street">
                                            <label class="mdl-textfield__label">Street # <span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="apartment">
                                            <label class="mdl-textfield__label">Apartment # <span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="streetName">
                                            <label class="mdl-textfield__label">Street name <span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="number" name="postCode">
                                            <label class="mdl-textfield__label">Postal code <span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="city">
                                            <label class="mdl-textfield__label">City <span class="required"> *</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-submit">
                                            <button class="pro-order-btn"> Continue </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="delivery-form-content">
                            <form id="pickupForm" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" name="name">
                                            <label class="mdl-textfield__label">Name<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="email" name="email">
                                            <label class="mdl-textfield__label">Email<span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="number" name="phone">
                                            <label class="mdl-textfield__label">Phone # <span class="required"> *</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-submit">
                                            <button class="pro-order-btn pickUpSave"> Save </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="boolDelivery" value="{{ !empty(session()->get('delivery_details')) ? 'yes' : '' }}">
<input type="hidden" id="boolPickUp" value="{{ !empty(session()->get('pickup_details')) ? 'yes' : '' }}">

<!-- --- login model ----- -->
<div class="modal fade" id="login" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="order-header-content-wrapper">
                    <h2>SIGN IN </h2>
                    <p style="width: 90%;margin: auto;">Sign in to your account and start earning Pizza Perks points on your next order. </p>
                    <img src="{{ asset('images/perks.png') }}" alt="perks" />
                </div>
                <div class="delivery-form-content sign-in-form">
                    <form id="loginForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="email" name="email">
                                    <label class="mdl-textfield__label">Email<span class="required"> *</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="password" name="password">
                                    <label class="mdl-textfield__label">Password <span class="required"> *</span></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-submit">
                                    <button type="submit" class="pro-order-btn"> Sign in </button>
                                </div>
                            </div>
                            <div class="login-form-footer-link">
                                <a href="" data-toggle="modal" data-target="#forgotPassword" data-dismiss="modal"><i>I forgot my password</i></a>
                                <a href="" data-toggle="modal" data-target="#register" data-dismiss="modal"><i>Don't have an account yet? Create one!</i></a>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- --- Register model ----- -->
<div class="modal fade" id="register" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="order-header-content-wrapper">
                    <h2>REGISTER </h2>
                    <p>Eat pizza. Get points. Get free pizza. Repeat. It's the pizza cycle of life. Become a Pizza Perks member and start earning today.</p>
                    <img src="{{ asset('images/perks.png') }}" alt="perks" />
                </div>
                <div class="delivery-form-content sign-in-form">
                    <form id="registerForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="email" name="email">
                                    <label class="mdl-textfield__label">Email<span class="required"> *</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="password" name="password">
                                    <label class="mdl-textfield__label">Password <span class="required"> *</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="number" name="phone">
                                    <label class="mdl-textfield__label">Phone #<span class="required"> *</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="text" name="firstname">
                                    <label class="mdl-textfield__label">First name <span class="required"> *</span></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-submit">
                                    <button type="submit" class="pro-order-btn registerbtn"> Register </button>
                                </div>
                            </div>
                            <div class="login-form-footer-link">
                                <a href="" data-toggle="modal" data-target="#login" data-dismiss="modal"><i>Already registered? Sign in!</i></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ---forget model----- -->
<div class="modal fade" id="forgotPassword" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-right">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="forgotpassword-content">
                    <h2>FORGOT PASSWORD</h2>
                    <p>Forgot your password? Let us help! Enter your email and we will send you a link to reset your password. </p>
                </div>

                <div class="delivery-form-content sign-in-form">
                    <form method="get" action="#">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input class="mdl-textfield__input" type="email" name="">
                                    <label class="mdl-textfield__label">Email<span class="required"> *</span></label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="form-submit">
                                    <button type="submit" class="pro-order-btn"> Submit </button>
                                </div>
                            </div>
                            <div class="login-form-footer-link">
                                <a href="" data-toggle="modal" data-target="#login" data-dismiss="modal"><i>Nevermind, I remember it!</i></a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/selectize.min.js') }}"></script>
<script src="{{ asset('js/stickybits.min.js') }}"></script>
<script src="{{ asset('js/owlCarousel.min.js') }}"></script>
<script src="{{ asset('js/wow.js')}}"></script>
<script src="{{ asset('js/all.js') }}"></script>
<script defer src="{{ asset('js/material.min.js') }}"></script>
<script src="{{ asset('js/toastr.js') }}"></script>
<script>
    $(document).ready(function() {

        stickybits('.main-header', {
            useStickyClasses: true
        });

        $(".selectpicker, .province, .s-store").selectize();

        $('.order-mobile-btn button').on('click', function() {
            $('.sidemenu').toggleClass('visible');
        });
        $('#body-overlay').click(function() {
            $('.sidemenu').removeClass('visible');
        });

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
    });

    //This function is to set the cart Price and atlast to show it
    function cart() {
        $.ajax({
            url: '{{ route("get-cart") }}',
            method: 'POST',
            data: {
                '_token': "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.status == 'success') {
                    var totalPrice = 0;

                    // Loop through each item in the cart
                    data.cart.forEach(function(item) {
                        // Assuming each item has a 'price' property
                        totalPrice += parseFloat(item.price);
                    });

                    // Update the HTML element with the calculated total price
                    $('.app__total').text('$' + totalPrice.toFixed(2));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding items to cart:', error);
            }
        });
    }

    $(document).ready(function() {
        //These are functionality based and this is what inserting the pizza data in modal
        $(document).on('click', '.checkSession', function(e) {
            e.preventDefault();
            $('#exampleModalLong').modal('hide');

            var delivery = $('#boolDelivery').val();
            var pickup = $('#boolPickUp').val();

            if (delivery || pickup) {
                var idOfPizza = $(this).data('id');
                $.ajax({
                    url: '{{route("getPizzaDetails")}}',
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': idOfPizza
                    },
                    cache: false,
                    async: false,

                    success: function(data) {
                        if (data.status == 'success') {
                            var sizes = data.data['size'].split(",");
                            var price = data.data['price'].split(",");

                            $('#nameOfPizza').text(data.data['name'].toUpperCase());
                            $('.ingredients').prop('checked', false);
                            $('#size option').each(function(index) {
                                // console.log($(this).val());
                                // console.log(price[index]);
                                $(this).attr('data-price', price[index]);
                                $(this).text($(this).text() + ' - $' + price[index]);
                            });

                            //This is for Meat
                            if (data.data.meat_ingredients && data.data.meat_ingredients.trim() !== '') {
                                var selectedMeatIDs = data.data.meat_ingredients.split(', ');

                                selectedMeatIDs.forEach(function(meatID) {
                                    // Select the checkbox with the corresponding data-meat attribute
                                    $('input[data-meat="' + meatID + '"]').prop('checked', true);

                                    // Select the corresponding option in the select element within the same meat_ingredients div
                                    $('input[data-meat="' + meatID + '"]').closest('.meat_ingredients').find('select[name="meatPortion"]').val('Reguler (1x)');

                                    // Select the default radio button within the same meat_ingredients div
                                    $('input[data-meat="' + meatID + '"]').closest('.meat_ingredients').find('.second-radio input[type="radio"]').prop('checked', true);
                                });
                            }

                            //This is for Veggies
                            if (data.data.veggies && data.data.veggies.trim() !== '') {
                                var veggiesIDS = data.data.veggies.split(', ');

                                veggiesIDS.forEach(function(veggiesID) {
                                    // Select the checkbox with the corresponding data-meat attribute
                                    $('input[data-veggies="' + veggiesID + '"]').prop('checked', true);

                                    // Select the corresponding option in the select element within the same meat_ingredients div
                                    $('input[data-veggies="' + veggiesID + '"]').closest('.veggies_ingredients').find('select[name="veggiesPortion"]').val('Reguler (1x)');

                                    // Select the default radio button within the same meat_ingredients div
                                    $('input[data-veggies="' + veggiesID + '"]').closest('.veggies_ingredients').find('input[name="radio-group"][checked]').prop('checked', true);
                                });
                            }

                            var prices = data.data.price.split(',');
                            $('#finalPrice').attr('data-finalprice', prices[0]);
                            $('#finalPrice').attr('data-original', prices[0])
                            $('#finalPrice').text(prices[0]);
                        }
                    }
                });

                var sizes = @json($pizza);
                var splitSizes = sizes[$(this).data('key')]['size'][0].split(",");

                splitSizes.forEach(function(val) {
                    $("#size").append('<option>' + val + "</option>");
                });

                $('#exampleModalLong').modal('show');
                $('#exampleModalLong #idOfPizza').val(idOfPizza);
            } else {
                $('#orderSetup').modal('show');
            }
        });
    });

    $(document).on('click', '#delivery_submit', function(e) {
        e.preventDefault();
        var formData = new FormData($('#delivery_form')[0]);

        $('#delivery_form')[0].reset();
        $.ajax({
            url: "{{ route('ordering') }}",
            type: 'POST',
            dataType: "JSON",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == 1) {
                    $('#exampleModalLong').modal('hide');
                    toastr.success('Your order number is #' + response.message);
                } else if (response.status == 0) {
                    $('#exampleModalLong').modal('hide');
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:' + error);
            }
        });
    });

    //To take the delivery address if the user is guest.
    $("#deliveryForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            city: {
                required: true
            },
            postCode: {
                required: true
            },
            streetName: {
                required: true
            },
            apartment: {
                required: true
            },
            street: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter your name"
            },
            email: {
                required: "Please enter email address",
                email: "Please enter your email address properly"
            },
            phone: {
                required: "Please enter your phone number"
            },
            city: {
                required: "Please enter your city"
            },
            postCode: {
                required: "Please enter your postcode"
            },
            streetName: {
                required: "Please enter the street name"
            },
            apartment: {
                required: "Please enter your Apartment"
            },
            street: {
                required: "Please enter Street"
            },
        },
        errorClass: "text-danger",
        submitHandler: function(form, e) {
            e.preventDefault();
            let data = new FormData(form);
            $.ajax({
                url: '{{route("delivery-setup")}}',
                type: "POST",
                dataType: "JSON",
                data: data,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success('Delivery address setup complete');
                        $("#deliveryForm").trigger('reset');
                        $('#orderSetup').modal('hide');
                        $('#boolDelivery').val('true');
                    } else {
                        toastr.error(data.message);
                        $("#deliveryForm").trigger('reset');
                        $('#orderSetup').modal('hide');
                    }
                }
            });
        }
    })

    $("#pickupForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter your name"
            },
            email: {
                required: "Please enter email address",
                email: "Please enter your email address properly"
            },
            phone: {
                required: "Please enter your phone number"
            },
        },
        errorClass: "text-danger",
        submitHandler: function(form, e) {
            e.preventDefault();
            let data = new FormData(form);
            $.ajax({
                url: '{{route("pickup-setup")}}',
                type: "POST",
                dataType: "JSON",
                data: data,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success('Delivery address setup complete');
                        $("#deliveryForm").trigger('reset');
                        $('#orderSetup').modal('hide');
                        $('#boolPickUp').val('true');
                    } else {
                        toastr.error(data.message);
                        $("#deliveryForm").trigger('reset');
                        $('#orderSetup').modal('hide');
                    }
                }
            });
        }
    })

    $("#registerForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            password: {
                required: true
            },
            firstname: {
                required: true
            },
        },
        messages: {
            name: {
                required: "Please enter your name"
            },
            email: {
                required: "Please enter email address",
                email: "Please enter your email address properly"
            },
            password: {
                required: "Please enter password"
            },
            phone: {
                required: "Please enter your phone number"
            },
            firstname: {
                required: "Please enter your name"
            },
        },
        errorClass: "text-danger",
        submitHandler: function(form, e) {
            e.preventDefault();
            let data = new FormData(form);
            $.ajax({
                url: '{{route("register")}}',
                type: "POST",
                dataType: "JSON",
                data: data,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#register').modal('hide');
                        $("#registerForm").trigger('reset');
                        $('#orderSetup').modal('show');
                        // $('#boolPickUp').val('true');
                    } else {
                        toastr.error(data.message);
                        $('#register').modal('hide');
                        $("#registerForm").trigger('reset');
                    }
                }
            });
        }
    })

    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
        },
        messages: {
            email: {
                required: "Please enter email address",
                email: "Please enter your email address properly"
            },
            password: {
                required: "Please enter password"
            },
        },
        errorClass: "text-danger",
        submitHandler: function(form, e) {
            e.preventDefault();
            let data = new FormData(form);
            $.ajax({
                url: '{{route("user.login")}}',
                type: "POST",
                dataType: "JSON",
                data: data,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#login').modal('hide');
                        $("#loginForm").trigger('reset');
                        location.reload();
                        // $('#orderSetup').modal('show');
                        // $('#boolPickUp').val('true');
                    } else {
                        toastr.error(data.message);
                        $('#login').modal('hide');
                        $("#loginForm").trigger('reset');
                    }
                }
            });
        }
    })

    //final order system
    $(document).on('change', '.ingredients', function(e) {
        if ($(this).is(':checked')) {
            // If checked, add to finalPrice
            var priceToAdd = parseFloat($(this).data('price'));
            var currentPrice = parseFloat($('#finalPrice').text());
            var newPrice = currentPrice + priceToAdd;
            $('#finalPrice').text(newPrice.toFixed(2));
        } else {
            // If unchecked, subtract from finalPrice
            var priceToSubtract = parseFloat($(this).data('price'));
            var currentPrice = parseFloat($('#finalPrice').text());
            var newPrice = currentPrice - priceToSubtract;
            $('#finalPrice').text(newPrice.toFixed(2));
        }
    });

    $(document).on('change', '.province', function(e) {
        // If checked, add to finalPrice
        var priceToAdd = parseFloat($(this).val());
        var currentPrice = parseFloat($('#finalPrice').attr('data-original'));
        var newPrice = currentPrice + priceToAdd;

        $('#finalPrice').attr('data-finalprice', newPrice.toFixed(2));
        $('#finalPrice').text(newPrice.toFixed(2));
    });

    $(document).on('click', '#orderBTN', function(e) {
        e.preventDefault();

        var type = "{{ $lastPart }}";
        var size = $('#size').val();
        var quantity = $('#quantity').val();
        var price = $('#finalPrice').attr('data-finalPrice');
        var crust = $('#crust').val();
        var thickness = $('#thickness').val();
        var sauce = $('#pills-Sauce select[name="sauce[]"]').val();

        var cheese = [];
        $('#pills-Sauce select[name="cheese[]"]').each(function() {
            cheese.push($(this).val());
        });

        var meat = [];
        $('#pills-meat input[name="meat[]"]:checked').each(function() {
            meat.push($(this).data('meat'));
        });

        var veggies = [];
        $('#pills-Veggiee input[name="veggies[]"]:checked').each(function() {
            veggies.push($(this).data('veggies'));
        });

        var extraSauce = [];
        $('#pills-Extras input[name="extraSauce[]"]:checked').each(function() {
            extraSauce.push($(this).data('sauce'));
        });

        $.ajax({
            url: '{{ route("add-to-cart") }}',
            method: 'POST',
            data: {
                '_token': "{{ csrf_token() }}",
                'type': type,
                'quantity': quantity,
                'size': size,
                'price': price,
                'crust': crust,
                'thickness': thickness,
                'sauce': sauce,
                'cheese': cheese,
                'meat': meat,
                'veggies': veggies,
                'extraSauce': extraSauce
            },
            success: function(data) {
                if (data.status == 'success') {
                    cart();
                    toastr.success(data.message);
                    $('#exampleModalLong').modal('hide');
                } else {
                    toastr.error("Something went Wrong");
                    $('#exampleModalLong').modal('hide');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding items to cart:', error);
            }
        });
    });

    // Function to handle increasing quantity
    $('.qty-btn-plus').on('click', function() {
        var inputQty = $(this).siblings('.input-qty');
        var currentValue = parseInt(inputQty.val());
        inputQty.val(currentValue + 1);

        // Update the final price by multiplying with the quantity
        var finalPrice = parseFloat($('#finalPrice').attr('data-finalprice'));
        var totalPrice = finalPrice * inputQty.val();
        $('#finalPrice').text(totalPrice.toFixed(2));
    });

    // Function to handle decreasing quantity
    $('.qty-btn-minus').on('click', function() {
        var inputQty = $(this).siblings('.input-qty');
        var currentValue = parseInt(inputQty.val());
        if (currentValue > 1) {
            inputQty.val(currentValue - 1);
            // Update the final price by multiplying with the quantity
            var finalPrice = parseFloat($('#finalPrice').text());
            var originalPrice = parseFloat($('#finalPrice').attr('data-finalprice'));
            var totalPrice = finalPrice - originalPrice;
            $('#finalPrice').text(totalPrice.toFixed(2));
        }

    });
</script>
@endpush