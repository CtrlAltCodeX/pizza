@extends('admin.master')
@section('title','Category')

@section('main')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            <div class="mb-sm-4 d-flex flex-wrap align-items-center text-head">
                <h2 class="mb-3 me-auto">Category</h2>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
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
                    <a href="javascript:void(0);" class="btn btn-primary btn-rounded me-3 mb-2"><i
                            class="fas fa-user-friends me-2 category_master"></i>+ Add New Category</a>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal"
                            data-bs-target="#addNewCategory">+ Add New Category</button>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="categoryTable" class="display" style="min-width: 845px"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="addNewCategory" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form id="categoryForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description" placeholder="Description">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image" placeholder="Image of the category">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveCategory">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UpdateCategory" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form">
                        <form id="updateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description" placeholder="Description">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image" placeholder="Image of the category">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary updateCategory">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script !src="">
        let dataTable = $("#categoryTable").DataTable({
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
                {data: "name", title: "name"},
                {data: "image", title: "image"},
                {data: "status", title: "status", class: "text-center",},
                {data: "action", title: "action", class: "text-center"}
            ],
            ajax: {
                url: '{{route('admin.category')}}',
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

        //this is to add a new Category
        $(document).on('click', '.saveCategory', function(e){
            var data = new FormData($('#categoryForm')[0]);
            $('#addNewCategory').modal('hide');
            $.ajax({
               url: "{{ route('admin.addNewCategory') }}",
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
                        // $("#loginForm").trigger('reset');
                        $('#addNewCategory #categoryForm')[0].reset();
                        dataTable.ajax.reload();
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

        $(document).on('click', '.editItem', function(e){
            e.preventDefault();
            var id = $(this).attr('id');

            $.ajax({
                url: "{{ route('admin.get-data') }}",
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function(response){
                    $('#UpdateCategory input[name="name"]').val(response.data.name);
                    $('#UpdateCategory input[name="description"]').val(response.data.description); // Fixed selector for description
                    $('#UpdateCategory .updateCategory').attr('data-id', response.data.id);
                }
            });
        });

        $(document).on('click', '.updateCategory', function (e){
            var data = new FormData($('#updateForm')[0]);
            var id = $('#UpdateCategory .updateCategory').data('id');
            data.append('id', id);

            $('#UpdateCategory').modal('hide');
            $.ajax({
                url: "{{ route('admin.category-update') }}",
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
                        // $("#loginForm").trigger('reset');
                        $('#addNewCategory #categoryForm')[0].reset();
                        dataTable.ajax.reload();
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
                    url: "{{ route('admin.category-status') }}",
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
