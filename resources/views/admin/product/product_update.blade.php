@extends('admin.master')
@section('title','Category')

@section('main')

@php
$sauceArray = !empty($data['sauces']) ? explode(',', $data['sauces']) : [];
$cheeseArray = !empty($data['cheese']) ? explode(',', $data['cheese']) : [];
$meatArray = !empty($data['meat_ingredients']) ? explode(',', $data['meat_ingredients']) : [];
$veggiesArray = !empty($data['veggies']) ? explode(',', $data['veggies']) : [];
$extraArray = !empty($data['extra']) ? explode(',', $data['extra']) : [];
$priceArray = !empty($data['price']) ? explode(',', $data['price']) : '';
$sizeArray = !empty($data['size']) ? explode(',', $data['size']) : '';
@endphp


<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
            <h2 class="mb-3 me-auto">Items</h2>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Update Items</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <form id="updateForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Name of this dish</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ $data['name'] }}">
                        </div>
                    </div>

                    <div class="mb-3 row ">
                        <label class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                            <select name="category_id" id="single-select">
                                @foreach($category as $cat)
                                <option value="{{ $cat['id'] }}" {{ isset($data['category_master_id']) && $data['category_master_id'] == $cat['id'] ? 'selected' : '' }}>
                                    {{ $cat['name'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="basic-form row mb-3">
                        <label class="col-sm-3 col-form-label">Select Pizza Sauce</label>
                        <div class="mb-3 col-sm-9 row" id="sauceSelector">
                            @foreach($sauce as $sau)
                            @if($loop->index < 2) <div class="form-check pt-1 col-3">
                                <input type="checkbox" class="form-check-input" {{ isset($data['sauces']) && $data['sauces'] == $sau['id'] ? 'checked' : '' }} name="sauce[]" id="sauce-{{ $loop->index }}" value="{{ $sau['id'] }}">
                                <label class="form-check-label" for="sauce-{{ $loop->index }}">{{ $sau['name'] }}</label>
                        </div>
                        @else
                        @break
                        @endif
                        @endforeach
                    </div>
            </div>

            <div class="basic-form row mb-3">
                <label class="col-sm-3 col-form-label">Select Extra Sauce</label>
                <div class="mb-3 col-sm-9 row" id="extraSauceSelector">
                    @foreach($sauce as $sau)
                    @if($loop->index >= 2)
                    <div class="form-check pt-1 col-2 ">
                        <input type="checkbox" class="form-check-input" name="extra[]" {{ in_array($sau['id'], $extraArray) ? 'checked' : '' }} id="extra-{{ $loop->index }}" value="{{ $sau['id'] }}">
                        <label class="form-check-label" for="extra-{{ $loop->index }}">{{ $sau['name'] }}</label>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>

            <div class="basic-form row mb-3">
                <label class="col-sm-3 col-form-label">Select cheese</label>
                <div class="mb-3 col-sm-9 row" id="cheeseSelector">
                    @foreach($cheese as $ches)
                    <div class="form-check pt-1 col-2">
                        <input type="checkbox" class="form-check-input" name="cheese[]" {{ in_array($ches['id'], $cheeseArray) ? 'checked' : '' }} id="cheese-{{ $loop->index }}" value="{{ $ches['id'] }}">
                        <label class="form-check-label" for="cheese-{{ $loop->index }}">{{ $ches['name'] }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="basic-form row mb-3">
                <label class="col-sm-3 col-form-label">Select Meat</label>
                <div class="mb-3 col-sm-9 row" id="meatSelector">
                    @foreach($meat as $mead)
                    <div class="form-check pt-1 col-2">
                        <input type="checkbox" class="form-check-input" name="meat[]" {{ in_array($mead['id'], $meatArray) ? 'checked' : '' }} id="meat-{{ $loop->index }}" value="{{ $mead['id'] }}">
                        <label class="form-check-label" for="meat-{{ $loop->index }}">{{ $mead['name'] }}</label>
                    </div>
                    @endforeach
                </div>
            </div>


            <div class="basic-form row mb-3">
                <label class="col-sm-3 col-form-label">Select Veggies</label>
                <div class="mb-3 col-sm-9 row" id="veggiesSelector">
                    @foreach($veggies as $vegies)
                    <div class="form-check pt-1 col-2">
                        <input type="checkbox" class="form-check-input" name="veggies[]" {{ in_array($vegies['id'], $veggiesArray) ? 'checked' : '' }} id="veggies-{{ $loop->index }}" value="{{ $vegies['id'] }}">
                        <label class="form-check-label" for="veggies-{{ $loop->index }}">{{ $vegies['name'] }}</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Calories Per Slice</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="calories" placeholder="Calories Per Slice" value="{{ $data['calories'] }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Prices for {{ isset($sizeArray[0]) ? $sizeArray[0] : '' }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="priceSM" placeholder="Price" value="{{ isset($priceArray[0]) ? $priceArray[0] : '' }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Prices for {{ isset($sizeArray[1]) ? $sizeArray[1] : '' }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="priceM" placeholder="Price" value="{{ isset($priceArray[1]) ? $priceArray[1] : '' }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Prices for {{ isset($sizeArray[2]) ? $sizeArray[2] : '' }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="priceL" placeholder="Price" value="{{ isset($priceArray[2]) ? $priceArray[2] : '' }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Prices for {{ isset($sizeArray[3]) ? $sizeArray[3] : '' }}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="priceXL" placeholder="Price" value="{{ isset($priceArray[3]) ? $priceArray[3] : '' }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Sizes</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{ $data['size'] }}" name="size" placeholder="">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Image</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" name="image" placeholder="Image of the Item">
                </div>
            </div>
            </form>
        </div>
        <button type="button" class="btn btn-primary updateItem col-xl-3 mx-auto">Update changes</button>
    </div>

</div>
</div>

@endsection
@section('js')
<script !src="">
    //this is to add a new Item
    $(document).on('click', '.updateItem', function(e) {
        var data = new FormData($('#updateForm')[0]);
        data.append('id', "{{ $data['id'] }}");
        $.ajax({
            url: "{{ route('admin.updateItem') }}",
            type: "POST",
            dataType: "JSON",
            data: data,
            cache: false,
            async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.status == 1) {
                    Swal.fire({
                        title: 'Success',
                        text: data.message,
                        type: 'success',
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    // $("#loginForm").trigger('reset');
                    window.location.href = "{{ route('admin.items') }}";
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
            }
        });
    });
</script>
@endsection