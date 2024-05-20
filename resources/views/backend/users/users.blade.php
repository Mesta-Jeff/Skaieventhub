

@extends('backend.layouts.app')

@section('title', 'Users List')

@section('content')
    <!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a >{{ env('APP_NAME')}}</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
                <h4 class="page-title">@yield('title')</h4>
            </div>
        </div>
        <hr style="margin-top: -20px;">
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <button type="button" id="btnNew" class="btn btn-outline-success mb-2 btn-sm rounded-2" >Add New Record</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example" class="table align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Open</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">..</h4>
            </div>
            <form id="my-form" method="post" action="save_data.php" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="gottenid" />
                    <div class="row g-9">
                        <div class="col-md-12 fv-row">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control" name="username" placeholder="Enter Username"  />
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="form-label" for="username">Gender</label>
                            <input type="text" id="gender" class="form-control" name="gender" placeholder="Enter Gender"  />
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="form-label" for="username">Dob</label>
                            <input type="text" id="dob" class="form-control" name="dob" placeholder="Enter Dob"  />
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="form-label" for="username">Image</label>
                            <input type="text" id="image" class="form-control" name="image" placeholder="Enter Image"  />
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="form-label" for="username">Phone</label>
                            <input type="text" id="phone" class="form-control" name="phone" placeholder="Enter Phone" maxlength="10"  />
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="form-label" for="password">Password</label>
                            <input type="text" id="password" class="form-control" name="password" placeholder="Enter Password"  />
                        </div>
                        <div class="col-md-12 fv-row">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email"  />
                        </div>

                        <div class="mb-1" style="display: none;" id="state-view">
                            <label for="status" class="form-label">Select Status</label>
                            <select class="form-select" name="stat" id="stat">
                                <option value="Active">Active</option>
                                <option value="InActive">InActive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="edit-data">Proceed</button>
                    <button type="button" class="btn btn-primary btn-sm" id="save-data">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function ()
    {
        var dataTable = "";
        var counter = 0;


        //calling the model to add new
        $('#btnNew').click(function() {
            $('#my-form')[0].reset();
            $('#modal-title').text('Add New Records');
            $('#my-modal').modal('show');
            $('#state-view').hide();
            $('#edit-data').hide();
            $('#save-data').show();
        });

        // Event listener for edit button
        $('#example').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var role = $(this).data('role');
            var description = $(this).data('description');
            var status = $(this).data('status');

            $('#modal-title').text('About to modify this record');
            $('#role').val(role);
            $('#gottenid').val(id);
            $('#description').text(description);
            $('#stat').val(status);
            $('#state-view').show();
            $('#save-data').hide();
            $('#edit-data').show();
            $('#my-modal').modal('show');

        });

        // Save Data Button Click Event
        $('#save-data').on('click', function() {
            // Get form values
            var username = $('#username').val();
            var password = $('#password').val();
            var email = $('#email').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Check if fields are not empty
            if (!password || !username || !email) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Please fill in all fields.' });
                return;
            }

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            // Create FormData object
            var formData = new FormData();
            formData.append('name', username);
            formData.append('password', password);
            formData.append('email', email);
            formData.append('dob', $('#dob').val());
            formData.append('gender', $('#gender').val());
            formData.append('phone', $('#phone').val());
            formData.append('image', $('#image').val());
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                type: 'POST',
                url: '{{ route("user.freeRoute") }}',
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {
                    console.log('Success Response:', response);
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    $('#my-form')[0].reset();
                    $('#my-modal').modal('hide');

                    if (response.success) {
                        // Swal.fire({ icon: 'success', title: 'Good Job', text: response.message + " Token: " + response.token});
                        Swal.fire({icon: 'success',title: 'Good Job', text: response.message });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    Swal.fire({ icon: 'error', title: 'Error', text: 'AJAX request failed: ' + textStatus + ', ' + errorThrown });
                }
            });
        });




        // Edit Data Button Click Event
        $('#edit-data').on('click', function() {
            var roles = $('#role').val();
            var des = $('#description').val();
            var stat = $('#stat').val();
            var gottenid = $('#gottenid').val();

            // Check if fields are not empty
            if (!roles || !des) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Both Role and Description fields are required.' });
                return;
            }

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr("disabled", true);

            $.ajax({
                type: "POST",
                url: '{{ route('user.update') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    role: roles,
                    des: des,
                    stat: stat,
                    id: gottenid
                },
                success: function(response) {
                    console.log('Success Response:', response);
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    $('#my-form')[0].reset();
                    $('#my-modal').modal('hide');
                    counter = 0;
                    dataTable.ajax.reload();
                    if (response.status === "success") {
                        Swal.fire({ icon: 'success', title: 'Good Job', text: response.message,});
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "AJAX request failed: " + textStatus + ", " + errorThrown
                    });
                }
            });
        });

        // Event listener for delete button
        $('#example').on('click', '.delete-btn', function(e) {
            var ids = $(this).data('id');
            var rol = $(this).data('rol');
            var message = 'Are you sure you want to delete this record? <strong>' + rol + '</strong>';
            Swal.fire({
                title: 'Confirm Deletion',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'No, cancel',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('user.distroy') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function(response) {
                            console.log('Success Response:', response);
                            counter = 0;
                            dataTable.ajax.reload();
                            if (response.status === "success") {
                                Swal.fire({ icon: 'success', title: 'Good Job', text: response.message,});
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "AJAX request failed: " + textStatus + ", " + errorThrown
                            });
                        }
                    });
                } else {
                    console.log("Delete action canceled by user.");
                }
            });
        });

        $("#role").val("");   //resetting the roles

    });
</script>

@endsection
