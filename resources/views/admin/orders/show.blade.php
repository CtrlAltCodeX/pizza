@extends('admin.master')
@section('title','Orders')

@section('main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Basic Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>User Name:</strong>
                            {{ $order->first_name ?? '' }} {{ $order->last_name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $order->email ?? '' }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $order->mobile ?? '' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Order Status</label>
                        <form action="{{ route('admin.update.status', $id) }}" class="d-flex">
                            <select class="form-control" name="status">
                                <option value="">--Select--</option>
                                <option value=0 {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                <option value=1 {{ $order->status == 1 ? 'selected' : '' }}>Delivered</option>
                                <option value=2 {{ $order->status == 2 ? 'selected' : '' }}>Dispatched</option>
                            </select>
                            <button type="submit" class="btn btn-warning" href="#">Update</button>
                        </form>
                    </div>
                </div>
                <hr> <!-- Horizontal line to separate basic details from table -->

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Details</h5>
                        <div class="table-responsive">
                            <table id="orderTable" class="table table-bordered" style="min-width: 1200px">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Item Name</th>
                                        <th>Category Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Ingredients</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    @php
                                    $ingredents = explode(',', $item->igredients_used_id);
                                    $ingredeint = app('App\Models\IngredientsMaster')->whereIn('id', $ingredents)->pluck('name')->toArray();
                                    @endphp

                                    <tr>
                                        <td><img src='/public/admin/images/items/MOD2945.png' width="100" /></td>
                                        <td>{{ $item->item_master->name ?? '' }}</td>
                                        <td>{{ $item->category->name ?? '' }}</td>
                                        <td>{{ $item->quantity ?? '' }}</td>
                                        <td>{{ $item->price ?? '' }}</td>
                                        <td>{{ implode(', ',$ingredeint) ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection