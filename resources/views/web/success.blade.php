@extends("web.layout.master")

@php

@endphp

@section("section")

<div class="jumbotron text-center">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead"><strong>Your Payment is recieved</p>
    <hr>
    <p class="lead">
        <a class="btn btn-primary btn-sm" href="{{url('/')}}" role="button">Continue to homepage</a>
    </p>
</div>

@endsection