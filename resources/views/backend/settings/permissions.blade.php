

@extends('backend.layouts.app')

@section('title', 'Systeme Permissions')

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


<div class="modal fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
                                <option value="" selected disabled>---- Select Option ----</option>

                                <!-- Full Settings Group -->
                                <optgroup label="About Settings">
                                    <option value="view-roles">View Roles</option>
                                    <option value="view-permissions">View Permissions</option>
                                    <option value="set-contract">Set Contract</option>
                                    <option value="set-payslip">Set Payslip</option>
                                    <option value="set-leave">Set Leave</option>
                                    <option value="set-leave-claims">Set Leave Claims</option>
                                    <option value="set-wage">Set Wage</option>
                                    <option value="view-groups">View Groups</option>
                                    <option value="view-factory">View Factory</option>
                                    <option value="configure-system">Configure System</option>
                                </optgroup>

                                <!-- Full Workers Group -->
                                <optgroup label="About Workers">
                                    <option value="view-casual-workers">View Casual Workers</option>
                                    <option value="view-contract-workers">View Contract Workers</option>
                                    <option value="view-permanent-workers">View Permanent Workers</option>
                                    <option value="assign-worker-permission">Assign Worker Permission</option>
                                    <option value="effect-promotion">Effect Promotion</option>
                                </optgroup>

                                <!-- Full Contracts Group -->
                                <optgroup label="About Contracts">
                                    <option value="sign-contract">Sign Contract</option>
                                    <option value="terminate-contract">Terminate Contract</option>
                                    <option value="pending-contract-request">Pending Contract Request</option>
                                    <option value="contract-review">Contract Review</option>
                                    <option value="batch-assignment">Batch Assignment</option>
                                    <option value="issue-contract-statement">Issue Contract Statement</option>
                                    <option value="extend-contract-individual">Extend Contract Individual</option>
                                    <option value="extend-group-contract">Extend Group Contract</option>
                                </optgroup>

                                    <!-- Full Requests Group -->
                                <optgroup label="About Requests">
                                    <option value="attendance-list">Attendance List</option>
                                    <option value="workers-records">Workers Records</option>
                                    <option value="requested-loans">Requested Loans</option>
                                    <option value="account-minute">Account Minute</option>
                                    <option value="promotion-claims">Promotion Claims</option>
                                    <option value="leave-claims">Leave Claims</option>
                                    <option value="excuse-duties">Excuse Duties</option>
                                    <option value="requested-days">Requested Days</option>
                                </optgroup>

                                <!-- Full Leaves Group -->
                                <optgroup label="About Leaves">
                                    <option value="leave-requests">Leave Requests</option>
                                    <option value="requests-days">Requests Days</option>
                                    <option value="pending-leaves">Pending Leaves</option>
                                    <option value="due-leaves">Due Leaves</option>
                                    <option value="enforce-leave">Enforce Leave</option>
                                    <option value="reschedule-leave">Reschedule Leave</option>
                                </optgroup>

                                <!-- Full Attendances Group -->
                                <optgroup label="About Attendances">
                                    <option value="upload-attendance">Upload Attendance</option>
                                    <option value="remark-attendance">Remark Attendance</option>
                                    <option value="review-attendance">Review Attendance</option>
                                    <option value="check-days-worker">Check Days Worker</option>
                                    <option value="check-group-days">Check Group Days</option>
                                    <option value="days-claims">Days Claims</option>
                                    <option value="generate-timetable">Generate Timetable</option>
                                </optgroup>

                                <!-- Full Loans Group -->
                                <optgroup label="About Loans">
                                    <option value="process-loan">Process Loan</option>
                                    <option value="approve-loan">Approve Loan</option>
                                    <option value="loan-statements">Loan Statements</option>
                                </optgroup>

                                <!-- Full Payslips Group -->
                                <optgroup label="About Payslips">
                                    <option value="approve-payslip">Approve Payslip</option>
                                    <option value="financial-ticket">Financial Ticket</option>
                                    <option value="generate-pincode">Generate Pincode</option>
                                    <option value="prepare-payslip">Prepare Payslip</option>
                                    <option value="release-salary">Release Salary</option>
                                    <option value="release-pincode">Release Pincode</option>
                                    <option value="verify-payslip">Verify Payslip</option>
                                    <option value="view-slip-ticket">View Slip Ticket</option>
                                    <option value="withheld-payslip">Withheld Payslip</option>
                                </optgroup>

                                <optgroup label="About Highest Level">
                                    <option value="Developer-Option">Super Permission</option>
                                    <option value="Admin-Option">Admin Permssion</option>
                                    <option value="Hr-Option">Moderator Permission</option>
                                </optgroup>

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

        function getPermissions() {
            $.ajax({
                url: '{{ route("fetch-permission") }}',
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
                url: '{{ route("ss.permissions") }}',
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
                url: '{{ route("add-permission") }}',
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
                        url: '{{ route("distroy-permission") }}',
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
