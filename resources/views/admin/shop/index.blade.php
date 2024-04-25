@extends('admin.master')
@section('title','Shop')

@section('main')

<div class="content-body">
    <div class="w-100 text-end">
        <a class="btn btn-warning" href="#" data-bs-toggle="modal" data-bs-target="#new-Shop">Create</a>
    </div>
    <!-- row -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table id="shopTable" class="display" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UpdateShop" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Shop</h5>
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
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option value=1>On</option>
                                    <option value=0>Off</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updateShop">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="new-Shop" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Shop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form id="newShop" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status">
                                    <option value=1>On</option>
                                    <option value=0>Off</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary createNewShop">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script type="text/javascript">
    $(function() {
        var table = $('#shopTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ]
        });
        $(document).ready(function() {
            $(document).on('click', '.updateShop', function(e) {
                var data = $('#updateForm').serialize();
                var id = $('.editItem').data('id');

                $('#UpdateShop').modal('hide');
                $.ajax({
                    url: "{{ route('shop.update', ':id') }}".replace(':id', id),
                    type: "POST",
                    dataType: "JSON",
                    data: data,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
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
                            // $('#addNewCategory #categoryForm')[0].reset();
                            table.ajax.reload();
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

            $(document).on('click', '.editItem', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('shop.edit', ':id') }}".replace(':id', id),
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': id
                    },
                    success: function(response) {
                        $('#UpdateShop input[name="name"]').val(response.data.name);
                        $('#UpdateShop input[name="status"]').val(response.data.status);
                    }
                });
            });

            $(document).on('click', '.deleteItem', function(e) {
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('shop.delete', ':id') }}".replace(':id', id),
                    type: "POST",
                    dataType: "JSON",
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
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
                            // $('#addNewCategory #categoryForm')[0].reset();
                            table.ajax.reload();
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
            
            $(document).on('click', '.createNewShop', function(e) {
                var data = $('#newShop').serialize();

                $('#new-Shop').modal('hide');
                $.ajax({
                    url: "{{ route('shop.store') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: data,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
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
                            // $('#addNewCategory #categoryForm')[0].reset();
                            table.ajax.reload();
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
        })
    });
</script>
@endpush