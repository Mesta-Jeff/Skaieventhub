

@extends('backend.layouts.app')

@section('title', 'System Permissions')

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
                            <button id="btnNew" type="button" class="btn btn-outline-success mb-2 btn-sm rounded-2" >Add New Record</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example" class="table align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permission</th>
                                    <th>Key</th>
                                    <th>Status</th>
                                    <th>Responsibilities</th>
                                    <th>Date Created</th>
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


<div class="modal fade modal-blur" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">..</h4>
            </div>
            <form id="my-form" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="gottenid" />
                    <div class="row g-9">
                        <div class="col-md-12 fv-row">
                            <select id="permission" class="select2 form-control mb-2" data-toggle="select2">
                                <option value="" selected disabled>Choose...</option>
                            </select>
                        </div>
                        <div class="form-outline col-md-12 fv-row mb-2">
                            <label for="status" class="form-label">What can the permission do in the system</label>
                            <select class="select2 form-control mb-2" data-toggle="select2" id="action">
                                <option value="" selected disabled>---- Select Option ----</option>
                                <option value="Specific">Specific</option>
                                <option value="[*]">Everything</option>
                            </select>
                        </div>
                        <div class="mb-1" style="display: none;" id="state-view">
                            <label for="status" class="form-label">Select Status</label>
                            <select class="select2 form-control mb-2" data-toggle="select2" name="stat" id="stat">
                                <option value="Active">Active</option>
                                <option value="InActive">InActive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-soft-info btn-sm" id="edit-data">Proceed</button>
                    <button type="button" class="btn btn-soft-success btn-sm" id="save-data">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('root/js/permission-access.js') }}"></script> --}}

<script>


    $(document).ready(function ()
    {
        var dataTable = "";
        var counter = 0;

        // Get the select element
        const permissionsSelect = document.getElementById('permission');

        // Function to convert snake-case to Title Case
        function toTitleCase(str) {
            return str.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        }
        // Loop through the sections and their inner permissions to create options
        sections.forEach(section => {
            section.innerPermissions.forEach(innerPermission => {
                const option = document.createElement('option');
                option.value = innerPermission;
                option.text = toTitleCase(innerPermission);
                permissionsSelect.add(option);
            });
        });


        // FUnction to get the existing permissions
        function getPermissions() {
            $.ajax({
                url: '{{ route("settings.permissions.get") }}',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $.each(data.permissions, function (key, value) {
                        $('#permission option[value="' + value.keys + '"]').hide();
                    });
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
                }
            });
        }
        getPermissions();


        //calling the model to add new
        $('#btnNew').click(function() {
            $('#my-form')[0].reset();
            $('#modal-title').text('Add New Records');
            $('#my-modal').modal('show');
            $('#state-view').hide();
            $('#edit-data').hide();
            $('#save-data').show();
            $('#description').text('');
        });


        //Getting the table ready
        dataTable = $('#example').DataTable({
            ajax: {
                url: '{{ route("settings.permissions.show") }}',
                dataSrc: 'permissions'
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row) {
                        return ++counter;
                    }
                },
                { data: 'name' },
                { data: 'keys' },
                { data: 'status' },
                { data: 'actions' },
                { data: 'created_at' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-danger btn-sm delete-btn" data-id="' + data.id + '" data-rol="' + data.name + '"><i class="mdi mdi-delete mx-1"></i>Remove</button>';
                    }
                }
            ],
            "drawCallback": function( settings ) {
                counter = 0;
            }
        });

        // Save Data Button Click Event
        $('#save-data').on('click', function() {
            var keys = $('#permission').val();
            var actions = $('#action').val();
            var names = $('#permission option:selected').text();


            if (!keys || !actions) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Please fill in all fields.' });
                return;
            }

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('keys', keys);
            formData.append('names', names);
            formData.append('actions', actions);

            $.ajax({
                type: 'POST',
                url: '{{ route("settings.permissions.create") }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Success Response:', response);
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    $('#my-form')[0].reset();
                    $('#my-modal').modal('hide');

                    counter = 0;
                    dataTable.ajax.reload();
                    getPermissions();

                    if (response.status === 'success') {
                        Swal.fire({ icon: 'success', title: 'Good Job', text: response.message });
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
                        url: '{{ route("settings.permissions.destroy") }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: ids
                        },
                        success: function(response) {

                            console.log('Success Response:', response);
                            counter = 0;
                            getPermissions();

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

        $("#permission").val("");   //resetting

    });
</script>

@endsection
