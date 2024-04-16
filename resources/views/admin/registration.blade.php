@extends('admin.master')
@section('title','Registration')

@section('main')

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('admin.registration') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="mb-1"><strong>Name</strong></label>
                        <input type="hidden" name="staff" value=1>
                        <input type="name" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1"><strong>Email</strong></label>
                        <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1"><strong>Password</strong></label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1"><strong>Mobile</strong></label>
                        <input type="number" name="phone" class="form-control" placeholder="Mobile">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1"><strong>Address</strong></label>
                        <textarea name="address" class='form-control'></textarea>
                    </div>

                    <button class='btn btn-warning'>Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection