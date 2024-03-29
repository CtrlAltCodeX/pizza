@extends("web.layout.master")

@push('css')
<style>
    /* Absolute Center Spinner */
    .payment_login {
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    /* Transparent Overlay */
    .payment_login:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

        background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
    }

    /* :not(:required) hides these rules from IE9 and below */
    .payment_login:not(:required) {
        /* hide "payment_login..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .payment_login:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 150ms infinite linear;
        -moz-animation: spinner 150ms infinite linear;
        -ms-animation: spinner 150ms infinite linear;
        -o-animation: spinner 150ms infinite linear;
        animation: spinner 150ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    }

    /* Animation */

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style>

@endpush

@section("section")
<div class="payment_login" style="display: none;">Loading&#8230;</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">{{count(session()->get('cart'))}}</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach(session()->get('cart') as $key => $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$item['name']}}</h6>
                    </div>
                    <span class="text-muted">{{ $item['price'] }}</span>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="{{ explode(' ',auth()->user()?->name)[0]??'' }}" required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="{{ explode(' ',auth()->user()?->name)[1]??'' }}" required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" value="{{ auth()->user()->email }}">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>

                <div class="mb-3">
                    <label for="mobile">Mobile</label>
                    <input type="mobile" class="form-control" id="mobile" placeholder="9999999999" value="{{ auth()->user()->mobile_no }}">
                    <div class="invalid-feedback"> Please enter a valid Mobile number for shipping updates. </div>
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                    <div class="invalid-feedback"> Please enter your shipping address. </div>
                </div>
                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" required="">
                            <option value="">Choose...</option>
                            @foreach($countries as $key => $country)
                            <option value="{{$key}}">{{$country}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback"> Please select a valid country. </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" placeholder="" required="">
                        <!-- <select class="custom-select d-block w-100" id="state" required="">
                            <option value="">Choose...</option>
                            <option>California</option>
                        </select>
                        <div class="invalid-feedback"> Please provide a valid state. </div> -->
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required="">
                        <div class="invalid-feedback"> Zip code required. </div>
                    </div>
                </div>
                <hr class="mb-4">
                <!-- <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                </div> -->
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
                <hr class="mb-4">
                <h4 class="mb-3">Payment</h4>
                <div class="d-block my-3">
                    <div class="custom-control custom-radio cod">
                        <input id="cod" name="paymentMethod" type="radio" class="custom-control-input">
                        <label class="custom-control-label" for="credit">Cash on Delivery ( COD )</label>
                    </div>
                    <div class="custom-control custom-radio online">
                        <input id="online" name="paymentMethod" type="radio" class="custom-control-input">
                        <label class="custom-control-label" for="debit">Online Payment</label>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit" id='payment'>Place Order</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $("#payment").click(function(e) {
            e.preventDefault();
            var data = @json(session()->get('cart'));
            var basicDetails = {
                first_name: $('#firstName').val(),
                last_name: $('#lastName').val(),
                email: $('#email').val(),
                mobile: $('#mobile').val()
            };

            var address = {
                address1: $("#address").val(),
                state: $("#state").val(),
                city: $("#state").val(),
                country: $("#country").val(),
                zip: $("#zip").val(),
                address2: $("#address2").val(),
            };

            if ($('#cod').prop('checked')) {
                $.ajax({
                    url: "{{ route('order.save') }}",
                    type: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        items: data,
                        address: address,
                        info: basicDetails
                    },
                    beforeSend: function() {
                        $(".payment_login").show();
                    },
                    success: function(response) {
                        $(".payment_login").hide();
                        window.location.href = '/success';
                    },
                    error: function(response) {
                        $(".payment_login").hide();
                        alert(response.responseJSON.error);
                    }
                });
            } else if ($('#online').prop('checked')) {
                $.ajax({
                    url: "{{ route('payment.link') }}",
                    type: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        items: data,
                        address: address,
                        info: basicDetails
                    },
                    beforeSend: function() {
                        $(".payment_login").show();
                    },
                    success: function(response) {
                        $(".payment_login").hide();
                        window.location.href = response.href;
                    },
                    error: function(response) {
                        $(".payment_login").hide();
                        console.log(response.responseJSON.error)
                        alert(response.responseJSON.error);
                    }
                })
            }
        });

        $(".cod").click(function() {
            $('#cod').attr('checked', true);
        });

        $(".online").click(function() {
            $('#online').attr('checked', true);
        });
    })
</script>
@endpush