<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from lezato.dexignzone.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jan 2024 03:32:56 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lezato : Restaurant Admin Template" />
    <meta property="og:title" content="Lezato : Restaurant Admin Template" />
    <meta property="og:description" content="Lezato : Restaurant Admin Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>{{env('APP_NAME')}} : Login</title>

    <!-- FAVICONS ICON -->
    @include('admin.layout.header-links')

</head>

<body class="vh-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="{{route('login')}}"><img src="{{asset('admin/images/logo-full.png')}}" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4">Sign in your account</h4>
                                <form id="loginForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
{{--                                    <div class="row d-flex justify-content-between mt-4 mb-2">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <div class="form-check custom-checkbox ms-1">--}}
{{--                                                <input type="checkbox" class="form-check-input" id="basic_checkbox_1">--}}
{{--                                                <label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <a href="page-forgot-password.html">Forgot Password?</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                    </div>
                                </form>
{{--                                <div class="new-account mt-3">--}}
{{--                                    <p>Don't have an account? <a class="text-primary" href="page-register.html">Sign up</a></p>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
@include('admin.layout.footer-links')


</body>
</html>
<script !src="">
    $("#loginForm").validate({
        rules: {
            email: {required: true, email: true},
            password: {required: true}
        },
        messages: {
            email: {required: "Please enter email address", email: "Please enter your email address properly"},
            password: {required: "Please enter your password"},
        },
        errorClass: "text-danger",
        submitHandler: function (form, e) {
            e.preventDefault();
            let data = new FormData(form);
            $.ajax({
                url: '{{route("admin.login-check")}}',
                type: "POST",
                dataType: "JSON",
                data: data,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $("#loginBtn").attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: data.message,
                            type: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        $("#loginForm").trigger('reset');
                        window.location.reload();
                    } else {
                        Swal.fire({
                            title: 'Failed',
                            text: data.message,
                            type: 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    }
                },
                complete: function () {
                    $("#loginBtn").removeAttr('disabled');
                }
            });
        }
    })
</script>
