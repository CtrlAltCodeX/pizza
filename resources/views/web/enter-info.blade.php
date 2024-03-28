<style>
    .padding {
        padding: 5rem !important;
    }

    .form-control:focus {
        box-shadow: 10px 0px 0px 0px #ffffff !important;
        border-color: #4ca746;
    }


<div class="loading" style="display: none;">Loading&#8230;</div>

<title>Card Details</title>
<link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" />
<div class="padding">
    <div class="row">
        <div class="container-fluid d-flex justify-content-center">
            <div class="col-sm-8 col-md-5">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-6">
                                <span>CREDIT/DEBIT CARD PAYMENT</span>
                            </div>
                            <div class="col-md-6 text-right" style="margin-top: -5px;">
                                <img src="https://img.icons8.com/color/36/000000/visa.png">
                                <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                                <img src="https://img.icons8.com/color/36/000000/amex.png">
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="height: 350px">
                        <div class="form-group">
                            <label for="cc-number" class="control-label">CARD NUMBER</label>
                            <input id="cc-number" type="tel" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label">CARD EXPIRY</label>
                                    <input id="cc-exp" type="tel" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="&bull;&bull; / &bull;&bull;" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cc-cvc" class="control-label">CARD CVC</label>
                                    <input id="cc-cvc" type="tel" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="&bull;&bull;&bull;&bull;" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="numeric" class="control-label">CARD HOLDER NAME</label>
                            <input type="text" class="input-lg form-control">
                        </div>

                        <div class="form-group">
                            <input id='payment' value="MAKE PAYMENT" type="button" class="btn btn-success btn-lg form-control" style="font-size: .8rem;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $("#payment").click(function() {
        var expiry = $("#cc-exp").val();
        $.ajax({
            url: "{{ route('card.token') }}",
            type: "POST",
            data: {
                '_token': '{{ csrf_token() }}',
                exp_month: expiry.split("/")[0],
                exp_year: expiry.split("/")[1],
                card_number: $("#cc-number").val(),
                cvv: $("#cc-cvc").val(),
            },
            beforeSend: function() {
                $(".loading").show();
            },
            success: function(response) {
                $(".loading").hide();

                var res = JSON.parse(response);
                console.log(res);
            },
            error: function(response) {
                $(".loading").hide();
                alert('Facing Some issues. Please contact Admin');
            }
        })
    })
</script>