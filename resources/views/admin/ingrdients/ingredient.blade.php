@extends('admin.master')
@section('title','Ingredients')

@section('main')

    @php
        //        echo '<pre>';
        //        print_r($category[0]['name']);
    @endphp
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Ingrdient</h2>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Ingrdient</a></li>
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
                            data-bs-target="#addNewIngredients">+ Add New Ingrdient</button>
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

    <div class="modal fade" id="addNewIngredients" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form id="addIngredientForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Name of this Ingredient</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">In which this will be used?</label>
                                <div class="col-sm-9">
                                    <select name="used_in" id="single-select">
                                        @foreach($category as $cat)
                                            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Under which this ingredieant is?</label>
                                <div class="col-sm-9">
                                    <select name="based_on" id=""  class="nice-select default-select form-control wide">
                                        <option value="crust">Crust</option>
                                        <option value="cheese">Cheese</option>
                                        <option value="sauce">Sauce</option>
                                        <option value="mayo">Mayo</option>
                                        <option value="meat">Meat</option>
                                        <option value="veggies">veggies</option>
                                        <option value="extra">Extra</option>
                                        <option value="bread">Bread</option>
                                        <option value="bread">Side</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Prices</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="price" placeholder="Price">
                                </div>
                            </div>

{{--                            <div class="mb-3 row">--}}
{{--                                <label class="col-sm-3 col-form-label">Sizes</label>--}}
{{--                                <div class="col-sm-9">--}}
{{--                                    <input type="text" class="form-control" name="size" placeholder="">--}}
{{--                                </div>--}}
{{--                            </div>--}}


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
                {data: "based_on", title: "Based On"},
                {data: "used_in", title: "used_in"},
                {data: "name", title: "name"},
                {data: "price", title: "Price"},
                {data: "image", title: "image"},
                // {data: "status", title: "status", class: "text-center",},
                {data: "action", title: "action", class: "text-center"}
            ],
            ajax: {
                url: '{{route('admin.ingredientTable')}}',

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

        {{--//this is to add a new Ingredients--}}
        $(document).on('click', '.saveItem', function(e){
            var data = new FormData($('#addIngredientForm')[0]);
            $('#addNewIngredients').modal('hide');
            $.ajax({
                url: "{{ route('admin.addIngredients') }}",
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
                        $('#addIngredientForm')[0].reset(); // Reset the form

                        // $("#loginForm").trigger('reset');
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

        //This is to deactivate/activate the category
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
                    url: "{{ route('admin.category-status') }}",
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
