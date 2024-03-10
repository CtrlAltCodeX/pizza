@extends('admin.master')
@section('title','Category')

@section('main')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Items</h2>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Items</a></li>
                    </ol>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center mb-4 flex-wrap">
                {{--                <div class="customer-search mb-sm-0 mb-3">--}}
                {{--                    <div class="input-group search-area">--}}
                {{--                        <input type="text" class="form-control" placeholder="Search here......">--}}
                {{--                        <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="d-flex align-items-center flex-wrap">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                            data-bs-target="#addNewItem">+ Add pizza/Pasta</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="itemTable" class="display" style="min-width: 845px"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @php
        //------------------  Pasta and Pizza Together  -------------------------
                    if(isset($Pizzas) && isset($Pastas)){
                        $sauce = isset($Pizzas) ? array_merge($Pizzas['sauce'], $Pastas['sauce']) : [];
                        $extraSauce = isset($Pizzas) ? array_merge($Pizzas['extraSauce'], $Pastas['sauce']) : [];
                        $cheese = isset($Pizzas) ? array_merge($Pizzas['cheese'], $Pastas['sauce']) : [];
                        $meat = isset($Pizzas) ? array_merge($Pizzas['meat'], $Pastas['sauce']) : [];
                        $veggies = isset($Pizzas) ? array_merge($Pizzas['veggies'], $Pastas['sauce']) : [];
                    }

        //---------------------  Sandwiches  -----------------------------------------------------
                    if(isset($Sandwiches)){
                        $sandwich_sauce = isset($Sandwiches['sauce']) ? $Sandwiches['sauce'] : [];
                        $sandwich_extraSauce = isset($Sandwiches['extraSauce']) ? $Sandwiches['extraSauce'] : [];
                        $sandwich_cheese = isset($Sandwiches['cheese']) ? $Sandwiches['cheese'] : [];
                        $sandwich_meat = isset($Sandwiches['meat']) ? $Sandwiches['meat'] : [];
                        $sandwich_veggies = isset($Sandwiches['veggies']) ? $Sandwiches['veggies'] : [];
                    }

    @endphp

    <div class="modal fade" id="addNewItem" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">

                    <div class="basic-form pizzaPasta">
                        <form id="addItemForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Name of this dish</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" id="single-select">
                                        @foreach($category as $cat)
                                            <option value="{{ $cat['id'] }}" data-name="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="Pizzas Pastas" style="display: none;">
                                <input type="hidden" name="category_type" value="PizzasPastas">
                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Sauce</label>
                                    <div class="mb-3 col-sm-9" id="sauceSelector">
                                        @foreach($sauce as $sau)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sauce[]" id="sauce-{{ $loop->index }}" value="{{ $sau['id'] }}">
                                                <label class="form-check-label" for="sauce-{{ $loop->index }}">{{ $sau['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Mark If you want to add Bread with this</label>
                                    <div class="mb-3 col-sm-9" id="want_bread">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="bread" id="bread-extra">
                                            <label class="form-check-label" for="bread-extra">Yes</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Extra Sauce</label>
                                    <div class="mb-3 col-sm-9" id="extraSauceSelector">

                                        @foreach($extraSauce as $extra)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="extra[]" id="extra-{{ $loop->index }}" value="{{ $extra['id'] }}">
                                                <label class="form-check-label" for="extra-{{ $loop->index }}">{{ $extra['name'] }}</label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select cheese</label>
                                    <div class="mb-3 col-sm-9" id="cheeseSelector">
                                        @foreach($cheese as $ches)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="cheese[]" id="cheese-{{ $loop->index }}" value="{{ $ches['id'] }}">
                                                <label class="form-check-label" for="cheese-{{ $loop->index }}">{{ $ches['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Meat</label>
                                    <div class="mb-3 col-sm-9" id="meatSelector">
                                        @foreach($meat as $mead)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="meat[]" id="meat-{{ $loop->index }}" value="{{ $mead['id'] }}">
                                                <label class="form-check-label" for="meat-{{ $loop->index }}">{{ $mead['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Veggies</label>
                                    <div class="mb-3 col-sm-9" id="veggiesSelector">
                                        @foreach($veggies as $vegies)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="veggies[]" id="veggies-{{ $loop->index }}" value="{{ $vegies['id'] }}">
                                                <label class="form-check-label" for="veggies-{{ $loop->index }}">{{ $vegies['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select which Topping can be added as extra</label>
                                    <div class="mb-3 col-sm-9" id="add_on_toppings">
                                        @if(!empty($veggies))
                                            @foreach($veggies as $vegies)
                                                <div class="form-check form-check-inline mb-2">
                                                    <input type="checkbox" class="form-check-input" name="add_on_toppings[]" id="add_on_toppingsV-{{ $loop->index }}" value="{{ $vegies['id'] }}">
                                                    <label class="form-check-label" for="#add_on_toppingsV-{{ $loop->index }}">{{ $vegies['name'] }}</label>
                                                </div>
                                            @endforeach
                                        @endif

                                        @if(!empty($meat))
                                            @foreach($meat as $mead)
                                                <div class="form-check form-check-inline mb-2">
                                                    <input type="checkbox" class="form-check-input" name="add_on_toppings[]" id="add_on_toppingsM-{{ $loop->index }}" value="{{ $mead['id'] }}">
                                                    <label class="form-check-label" for="#add_on_toppingsM-{{ $loop->index }}">{{ $mead['name'] }}</label>
                                                </div>
                                            @endforeach
                                        @endif

                                        @if(!empty($cheese))
                                            @foreach($cheese as $ches)
                                                <div class="form-check form-check-inline mb-2">
                                                    <input type="checkbox" class="form-check-input" name="add_on_toppings[]" id="add_on_toppingsC-{{ $loop->index }}" value="{{ $ches['id'] }}">
                                                    <label class="form-check-label" for="#add_on_toppingsC-{{ $loop->index }}">{{ $ches['name'] }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Calories Per Slice</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="calories" placeholder="Calories Per Slice">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices for Small(9'')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceSM" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices for Medium(12'')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceM" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices for large(15'')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceL" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices for Extra-Large(18'')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceXL" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Sizes</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="size" placeholder="">
                                    </div>
                                </div>

                            </div>

                            {{-- This is for Sandwiches Area --}}
                            <div class="Sandwiches" style="display:none">
                                <input type="hidden" name="category_type" value="Sandwiches">
                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Sauce</label>
                                    <div class="mb-3 col-sm-9" id="">
                                        @foreach($sandwich_sauce as $sau)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_sauce[]" id="sandwich_sauce-{{ $loop->index }}" value="{{ $sau['id'] }}">
                                                <label class="form-check-label" for="sandwich_sauce-{{ $loop->index }}">{{ $sau['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Extra Sauce</label>
                                    <div class="mb-3 col-sm-9" id="">
                                        @foreach($sandwich_extraSauce as $ext)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_extra[]" id="sandwich_extra-{{ $loop->index }}" value="{{ $ext['id'] }}">
                                                <label class="form-check-label" for="sandwich_extra-{{ $loop->index }}">{{ $ext['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select cheese</label>
                                    <div class="mb-3 col-sm-9" id="cheeseSelector">
                                        @foreach($sandwich_cheese as $ches)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_cheese[]" id="sandwich_cheese-{{ $loop->index }}" value="{{ $ches['id'] }}">
                                                <label class="form-check-label" for="sandwich_cheese-{{ $loop->index }}">{{ $ches['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Meat</label>
                                    <div class="mb-3 col-sm-9" id="meatSelector">
                                        @foreach($sandwich_meat as $mead)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_meat[]" id="sandwich_meat-{{ $loop->index }}" value="{{ $mead['id'] }}">
                                                <label class="form-check-label" for="sandwich_meat-{{ $loop->index }}">{{ $mead['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select Veggies</label>
                                    <div class="mb-3 col-sm-9" id="veggiesSelector">
                                        @foreach($sandwich_veggies as $vegies)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_veggies[]" id="sandwich_veggies-{{ $loop->index }}" value="{{ $vegies['id'] }}">
                                                <label class="form-check-label" for="sandwich_veggies-{{ $loop->index }}">{{ $vegies['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select which Topping can be added as extra</label>
                                    <div class="mb-3 col-sm-9" id="add_on_toppings">
                                        @foreach($sandwich_veggies as $vegies)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_add_on_toppings[]" id="add_on_toppingsV-{{ $loop->index }}" value="{{ $vegies['id'] }}">
                                                <label class="form-check-label" for="#add_on_toppingsV-{{ $loop->index }}">{{ $vegies['name'] }}</label>
                                            </div>
                                        @endforeach

                                        @foreach($sandwich_meat as $mead)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_add_on_toppings[]" id="add_on_toppingsM-{{ $loop->index }}" value="{{ $mead['id'] }}">
                                                <label class="form-check-label" for="#add_on_toppingsM-{{ $loop->index }}">{{ $mead['name'] }}</label>
                                            </div>
                                        @endforeach

                                        @foreach($sandwich_cheese as $ches)
                                            <div class="form-check form-check-inline mb-2">
                                                <input type="checkbox" class="form-check-input" name="sandwich_add_on_toppings[]" id="add_on_toppingsC-{{ $loop->index }}" value="{{ $ches['id'] }}">
                                                <label class="form-check-label" for="#add_on_toppingsC-{{ $loop->index }}">{{ $ches['name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Select what can be given as option to select </label>
                                    <div class="col-sm-9">
                                        <select name="as_anOption" class="nice-select me-sm-2 default-select form-control wide">
                                            <option value=""><-- Select --></option>
                                            <option value="Mayo"> Mayo</option>
                                            <option value="Sauce"> Sauce</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Calories Per Slice</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="calories" placeholder="Calories Per Slice">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceSM" placeholder="Price">
                                    </div>
                                </div>
                            </div>

                            {{-- This si for chicken --}}
                            <div class="Chicken" style="display:none">
                                <input type="hidden" name="category_type" value="Chicken">

                                <div class="basic-form row">
                                    <label class="col-sm-3 col-form-label">Choices given to Customer </label>
                                    <div class="mb-3 col-sm-9">
                                        <div class="form-check form-check-inline mb-2">
                                            <input type="checkbox" class="form-check-input" name="as_anOption[]" id="sauce1" value="sauce">
                                            <label class="form-check-label" for="sauce1">Sauce</label>
                                        </div>

                                        <div class="form-check form-check-inline mb-2">
                                            <input type="checkbox" class="form-check-input" name="as_anOption[]" id="side1" value="side">
                                            <label class="form-check-label" for="side1">Side</label>
                                        </div>

                                        <div class="form-check form-check-inline mb-2">
                                            <input type="checkbox" class="form-check-input" name="as_anOption[]" id="sauce_on_side" value="sauce_on_side">
                                            <label class="form-check-label" for="sauce_on_side">Sauce on the Side</label>
                                        </div>
                                    </div>
                                </div>



                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Calories Per Slice</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="calories" placeholder="Calories Per Slice">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceSM" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceM" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceL" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Prices</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="priceXL" placeholder="Price">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Sizes</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="size" placeholder="">
                                    </div>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveItem">Save changes</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('js')
    <script !src="">
        // $(document).ready(function(){
        //    $.ajax()
        // });

        let items = $("#itemTable").DataTable({
            retrieve: false,
            processing: true,
            responsive: true,
            serverSide: true,
            info: true,
            dom: "Bfrtip",
            lengthMenu: [
                [10, 25, 50, 75, -1],
                ["10 rows", "25 rows", "50 rows", "75 rows", "Show all"],
            ],
            columns: [
                {data: "DT_RowIndex", title: "Id", class: "text-center",},
                {data: "category_master_id", title: "Master Category"},
                {data: "name", title: "name"},
                // {data: "description", title: "Description"},
                {data: "price", title: "Price"},
                {data: "image", title: "image", orderable: false},
                {data: "status", title: "status", class: "text-center", orderable: false},
                {data: "action", title: "action", class: "text-center", orderable: false}
            ],
            ajax: {
                url: '{{route('admin.itemsTable')}}',
                data: {
                    '_token': '{{ @csrf_token() }}'
                },
                type: "POST",
                dataType: "JSON"
            },
            buttons: ["pageLength"],
            language: {
                // zeroRecords: nodatafound,
                search: '',
                searchPlaceholder: 'Search Here',
                // processing: loadercontent,
                paginate: {
                    next: '<i class="ri-arrow-right-s-line">',
                    previous: '<i class="ri-arrow-left-s-line">'
                },
                info: '<label>Showing page _PAGE_ of _PAGES_</label>',
                infoEmpty: "No records available",
            },
            responsive: {
                breakpoints: [
                    {name: "desktop", width: Infinity},
                    {name: "tablet", width: 1024},
                    {name: "fablet", width: 768},
                    {name: "phone", width: 480},
                ]
            },
        });

        $(document).on('change', '#single-select', function(e){
            var selectedCategory =  $(this).find('option:selected').data('name');
            $('.Pizzas, .Sandwiches, .Chicken').hide();
            $('.' + selectedCategory).show();

        });

        //this is to add a new Item
        $(document).on('click', '.saveItem', function(e){
            var data = new FormData($('#addItemForm')[0]);
            $('#addNewItem').modal('hide');
            $.ajax({
                url: "{{ route('admin.addNewItem') }}",
                type: "POST",
                dataType: "JSON",
                data: data,
                cache: false,
                async: false,
                processData: false,
                contentType: false,
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
                        $("#addItemForm")[0].reset();
                        // window.location.reload();
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

        //This is to deactivate/activate the item
        function status(button){
            var isChecked = button.checked;
            var id = button.id;
            if (isChecked) {
                $.ajax({
                    url: "{{ route('admin.item-status') }}",
                    type: "POST",
                    data: {
                        'isChecked': true,
                        'id': id,
                        "_token": '{{ csrf_token() }}'
                    },
                    success: function (response){
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            type: 'success',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    },
                    error: function (error){
                        Swal.fire({
                            title: 'error',
                            text: error,
                            type: 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    }
                })
            } else {
                $.ajax({
                    url: "{{ route('admin.item-status') }}",
                    type: "POST",
                    data: {
                        'isChecked': false,
                        'id': id,
                        "_token": '{{ csrf_token() }}'
                    },
                    success: function (response){
                        if(response.status == true){

                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                type: 'success',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        }
                        else if(response.status == false){
                            Swal.fire({
                                title: 'error',
                                text: response.message,
                                type: 'error',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function (error){
                        Swal.fire({
                            title: 'error',
                            text: error,
                            type: 'error',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    }
                })
            }
        }
    </script>
@endsection
