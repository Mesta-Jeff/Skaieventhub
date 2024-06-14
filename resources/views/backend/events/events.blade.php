@extends('backend.layouts.app')

@section('title', 'Events')

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

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <!--end col-->
                        <div class="col-xxl-9 ms-auto">
                            <div>
                                <select id="filter2" class="select2 form-control" >
                                    <option value="" selected>Filter by Event type...</option>
                                </select>
                            </div>
                        </div>

                        <!--end col-->
                        <div class="col-xxl-3 ms-auto">
                            <div class="hstack gap-2">
                                <button type="button" id="btnref" class="btn btn-soft-secondary">Reload</button>
                                <button type="button" id="btnNew" class="btn btn-outline-success waves-effect waves-light"><i class="mdi mdi-plus-circle me-1"></i> Add New</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12" >
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="eventStatus" id="current" value="current" checked>
                                <label class="form-check-label" for="current">Up Comming</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="eventStatus" id="past" value="past">
                                <label class="form-check-label" for="past">Past</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="eventStatus" id="all" value="all">
                                <label class="form-check-label" for="past">All</label>
                            </div>
                            <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove Selected</button>
                            <button class="btn btn-soft-success" type="button" id="bulk-approve" style="display: none" > Approve Selected</button>
                            <button class="btn btn-soft-danger" type="button" id="bulk-decline" style="display: none" > Decline Selected</button>

                        </div>
                    </div>
                    <hr style="margin-bottom: 15px !important;">

                    <div class="table-responsive">
                        <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllCheckboxes"/></th>
                                    <th>#</th>
                                    <th>Event Title</th>
                                    <th>Event Type</th>
                                    <th>Views</th>
                                    <th>Starting</th>
                                    <th>Ending</th>
                                    <th>Status</th>
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

<!-- Modal for action -->
<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="actionModalLabel">Actions</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="action-id" />
                <input type="hidden" id="action-creator" />
                <input type="hidden" id="action-title" />
                <div class="row g-9">
                    <div class="col-md-12 fv-row mb-2">
                        <label class="form-label">What do you want to do to this selected event...?</label>
                        <select id="modal-actions" class="select2 form-control mb-2" data-toggle="select2">
                            <option value="" selected disabled>---- Select Action ----</option>
                            <option value="more-details">More Details</option>
                            <option value="modify-event">Modify Event</option>
                            <option value="event-ticket">Event Ticket</option>
                            <option value="in-attendance">In Attendance</option>
                            <option value="comments">View Comments</option>
                            <option value="likes">Who Liked</option>
                            <option value="stars">View Stars</option>
                            <option value="viewers">See Viewers</option>
                            <option value="delete-record">Remove Event</option>

                            <option value="view-author">Who Created Event</option>
                            <option value="subscribe-sms">Subscribe SMS</option>
                            <option value="event-statistics">Event Statistics</option>
                            <option value="aprove-event">Approve Event</option>
                            <option value="decline-event">Decline Event</option>
                            <option value="suspend-event">Suspend Event</option>
                            <option value="verify-event">Verify Event</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-soft-danger btn-sm" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" id="gottenid" />
                    <div class="row g-9">
                        <div class="col-md-12 fv-row mb-2">
                            <select id="event" class="select2 form-control mb-2" data-toggle="select2">
                                <option value="" selected disabled>---- Select Option ----</option>
                                <optgroup label="Available Events Kinds We Offer">
                                    <option value="Award">Award Only</option>
                                    <option value="Award and Dinner">Award and Dinner</option>
                                    <option value="Dinner">Dinner Only</option>
                                    <option value="Music Fest">Music Fest</option>
                                    <option value="Movie">Movie Premiere</option>
                                    <option value="Comedy">Comedy Show</option>
                                    <option value="Church">Church Event</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-outline col-md-12 fv-row mb-2">
                            <label class="form-label" for="ides">Event Description</label>
                            <textarea id="description" class="form-control form-control-lg" rows="3" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" onkeydown="return /^([a-zA-Z]+[\s]*)*$/i.test(event.target.value + event.key)"></textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="status" class="form-text">How much will somenoe pay to signup</label>
                            <input type="text" class="form-control" placeholder="eg. 00.00" id="price" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" required/>
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
                    <button type="button" class="btn btn-soft-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-soft-info btn-sm" id="edit-data">Proceed</button>
                    <button type="button" class="btn btn-soft-success btn-sm" id="save-data">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>

<script>

    // Resseting forms
    function resetForm() {
        document.getElementById("my-form").reset();
        document.getElementById('current').checked = true;
    }

    // Allowing only Monetary values
    document.getElementById('price').addEventListener('input', function (e) {
      const input = e.target.value;
      const regex = /^[0-9]*\.?[0-9]*$/;
      if (!regex.test(input) || input.length > 7) {
        e.target.value = input.slice(0, -1);
      }
    });


    $(document).ready(function ()
    {
        var dataTable = "";
        var counter = 0;
        var event_id = '';
        var query_type ='No';

        // resetForm();
        $('input[name="eventStatus"]:checked').trigger('change');

        // to switch the view
        $('input[name="eventStatus"]').on('change', function() {

            if ($(this).val() === 'past') {
                query_type ="Yes";
            }
            else if ($(this).val() === 'all') {
                query_type = '';
            } else {
                query_type = "No";
            }

            fetchData(event_id, query_type, function(data) {
                initializeDataTable(data.events);
            });
        });

        // Function to handle the AJAX request
        function fetchData(event_id, query_type, callback) {

            $.ajax({
                url: '{{ route("events.show") }}',
                method: 'GET',
                data: { event_id: event_id, query_type : query_type},
                success: function(data) {
                    callback(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching data:', textStatus, errorThrown);
                }
            });
        }

        fetchData(event_id, query_type, function(data) {
            initializeDataTable(data.events);
        });

        //Getting the table ready
        function initializeDataTable(events) {
            let counter = 0;
            if ($.fn.dataTable.isDataTable('#example')) {
                $('#example').DataTable().clear().destroy();
            }
            dataTable = $('#example').DataTable({
                data: events,
                columns: [
                    {
                        data: null,
                        render: function (data, type, row) {
                            return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.event_title + '" />';
                        },
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return ++counter;
                        }
                    },
                    { data: 'event_title',
                        render: function(data, type, row) {
                            if (row.verified === true || row.verified === 1) {
                                data += ' <span data-bs-toggle="tooltip" data-bs-placement="left" title="This event has been verified" class="mdi mdi-check-decagram text-info"></span>';
                            }
                            return data;
                        }
                    },
                    { data: 'event_type' },
                    { data: 'views' },
                    { data: 'start_date' },
                    { data: 'end_date' },
                    // { data: 'status' },
                    {
                    data: 'status',
                        render: function(data, type, row) {
                            let badgeClass;
                            switch (data) {
                                case 'Approved':
                                    badgeClass = 'text-success';
                                    break;
                                case 'Declined':
                                    badgeClass = 'text-danger';
                                    break;
                                case 'Suspended':
                                    badgeClass = 'text-warning';
                                    break;
                                default:
                                    badgeClass = 'text-secondary';
                            }
                            return `<span class="${badgeClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                            <button type="button" class="btn btn-outline-info waves-effect waves-light btn-action" data-id="${data.id}" data-creator_id="${data.creator_id}" data-event="${data.event_title}" aria-expanded="false">
                                More Actions
                            </button>
                            <button type="button" class="btn btn-outline-danger waves-effect waves-light btn-remove" data-id="${data.id}" data-title="${data.event_title}" aria-expanded="false">
                                Drop Event
                            </button>`;
                        }
                    }
                ],
                drawCallback: function () {
                    counter = 0;
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                },
                lengthChange: false,
                responsive: true,
                buttons: ["copy", "excel", "csv", "print", "pdf"].map(function (type) {
                    return { extend: type, className: "btn-soft-success waves-effect waves-light" };
                }),
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left text-success'>",
                        next: "<i class='mdi mdi-chevron-right text-success'>"
                    }
                },
                initComplete: function(settings, json) {
                    dataTable.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
                    $('#selectAllCheckboxes').on('change', function () {
                        let isChecked = $(this).prop('checked');
                        $('.select-checkbox').prop('checked', $(this).prop('checked'));
                        $('#bulk-remove, #bulk-approve, #bulk-decline').toggle(isChecked);
                    });
                }
            });
        }

        // Calling action modal
        $('#example').on('click', '.btn-action', function() {
            var id = $(this).data('id');
            var event = $(this).data('event');
            var creator = $(this).data('creator_id');
            $('#action-id').val(id);
            $('#action-title').val(event);
            $('#action-creator').val(creator);


            $('#modal-actions')[0].selectedIndex = 0;
            $('#modal-actions').val('');

            $('.modal-title').text('You\'ve Selected ' + event);
            $('#actionModal').modal('show');

        });

        // Calling the action to drop the event
        $('#example').on('click', '.btn-remove', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            removeEventAction(id, title);
        });

        // Event listener for button click
        $('#bulk-remove').on('click', function () {
            var checkedCheckboxes = $('.select-checkbox:checked');
            if (checkedCheckboxes.length > 0) {
                let table='category'
                performBulkRemove(table);
            } else {
                Swal.fire({
                    icon: 'error',title: 'No Record selected',
                    text: 'Please select at least one record before removing.',
                });
            }
        });

        // Event listener for checkbox change
        $('#example tbody').on('change', '.select-checkbox', function () {
            var anyCheckboxChecked = $('.select-checkbox:checked').length > 0;
            $('#bulk-remove, #bulk-approve, #bulk-decline').toggle(anyCheckboxChecked);
        });

        // Function to perform the bulk remove action
        function performBulkRemove(table) {
            let selectedtitles = $('.select-checkbox:checked').map(function () {
                return $(this).data('title');
            }).get();
            let selectedIds = $('.select-checkbox:checked').map(function () {
                return $(this).data('id');
            }).get();

            let message = 'Are you sure you want to remove the item(s) below:<br><span class="text-danger"> ' + selectedtitles.join(', ') +'</span>';
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3BAFDA',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("account.cashout.create") }}',
                        type: 'POST',
                        data: { id: selectedIds, table: table },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            if (response.status === "success") {
                                Swal.fire({ icon: 'success', title: 'Good Job',text: response.message,})
                                .then((result) => {
                                    counter = 0;
                                    dataTable.ajax.reload();
                                    fetch_productImages();
                                    $('#bulk-remove').fadeOut();
                                });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                            }
                        },
                        error: function (xhr, status, error) {
                            if (xhr.responseJSON && xhr.responseJSON.status === 'error') {
                                Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON.message});
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: 'Request Failed: ' + status + ', ' + error});
                            }
                        }
                    });
                }
                else { dataTable.ajax.reload();}

            });
        }

        //calling the model to add new
        $('#btnNew').click(function() {
            resetForm();
            $('#modal-title').text('Add New Record');
            $('#my-modal').modal('show');
            $('#state-view, #edit-data').hide();
            $('#save-data').show();
            $('#description').text('');
        });

        //TO REFRESH THE Page
        $('#btnref').click( function(){
            // dataTable.ajax.reload();
            window.location.reload();
        })

        // Function to perform the "More Details" action
        function moreDetailsAction(id, title) {
            console.log('Performing More Details action for ID:', id, 'with title:', title);
            // Your code to perform the "More Details" action goes here
        }

        // Function to perform the "Modify Event" action
        function modifyEventAction(id, title) {
            console.log('Performing Modify Event action for ID:', id, 'with title:', title);
            // Your code to perform the "Modify Event" action goes here
        }

        // Function to perform the "Event Ticket" action
        function eventTicketAction(id, title) {
            console.log('Performing Event Ticket action for ID:', id, 'with title:', title);
            // Your code to perform the "Event Ticket" action goes here
        }

        // Function to perform the "In Attendance" action
        function inAttendanceAction(id, title) {
            console.log('Performing In Attendance action for ID:', id, 'with title:', title);
            // Your code to perform the "In Attendance" action goes here
        }

        // Function to perform the "View Comments" action
        function viewCommentsAction(id, title) {
            console.log('Performing View Comments action for ID:', id, 'with title:', title);
            // Your code to perform the "View Comments" action goes here
        }

        // Function to perform the "Who Liked" action
        function whoLikedAction(id, title) {
            console.log('Performing Who Liked action for ID:', id, 'with title:', title);
            // Your code to perform the "Who Liked" action goes here
        }

        // Function to perform the "View Stars" action
        function viewStarsAction(id, title) {
            console.log('Performing View Stars action for ID:', id, 'with title:', title);
            // Your code to perform the "View Stars" action goes here
        }

        // Function to perform the "See Viewers" action
        function seeViewersAction(id, title) {
            console.log('Performing See Viewers action for ID:', id, 'with title:', title);
            // Your code to perform the "See Viewers" action goes here
        }

        // Function to perform the "Remove Event" action
        function removeEventAction(id, title) {
            var message = 'Are you sure you want to remove this record? <strong>' + title + '</strong>';
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
                        url: '{{ route("events.types.destroy") }}',
                        data: {_token: '{{ csrf_token() }}',event_id: id},
                        success: function(response) {
                            console.log('Success Response:', response);
                            if (response.status="success") {
                                Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                                    .then((result) => {
                                        counter = 0; dataTable.ajax.reload();
                                    });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                            var errorMessage = '<strong>skaiTick transaction request failed because:</strong>';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage += '<br>' + xhr.responseJSON.message;
                            } else {
                                errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                            }
                            Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                        }
                    });
                } else {
                    console.log("Delete action canceled by user.");
                }
            });
        }

        // Function to perform the "View Author" action
        function viewAuthorAction(id, title) {
            console.log('Performing View Author action for ID:', id, 'with title:', title);
            // Your code to perform the "View Author" action goes here
        }

        // Function to perform the "Subscribe SMS" action
        function subscribeSmsAction(id, title) {
            console.log('Performing Subscribe SMS action for ID:', id, 'with title:', title);
            // Your code to perform the "Subscribe SMS" action goes here
        }

        // Function to perform the "Event Statistics" action
        function eventStatisticsAction(id, title) {
            console.log('Performing Event Statistics action for ID:', id, 'with title:', title);
            // Your code to perform the "Event Statistics" action goes here
        }

        // Function to perform the "Approve Event" action
        function approveEventAction(id, title, creator) {
            var message = 'Are you sure you want to approve this event? <strong>' + title + '</strong>';
            Swal.fire({
                title: 'Confirm Approval',
                html: message,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it',
                cancelButtonText: 'No, cancel',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route("events.approve") }}',
                        data: {_token: '{{ csrf_token() }}',id: id, creator_id: creator},
                        success: function(response) {
                            console.log('Success Response:', response);
                            if (response.status="success") {
                                Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                                    .then((result) => {
                                        $('#actionModal').modal('hide');
                                        fetchData(event_id, query_type, function(data) {
                                            initializeDataTable(data.events);
                                        });
                                    });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                            var errorMessage = '<strong>skaiTick transaction request failed because:</strong>';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage += '<br>' + xhr.responseJSON.message;
                            } else {
                                errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                            }
                            Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                        }
                    });
                } else {
                    console.log("Delete action canceled by user.");
                }
            });
        }

        // Function to perform the "Decline Event" action
        function declineEventAction(id, title, creator) {
            var message = 'Are you sure you want to decline this event? <strong>' + title + '</strong>';
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, decline it',
                cancelButtonText: 'No, cancel',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route("events.decline") }}',
                        data: {_token: '{{ csrf_token() }}',id: id, creator_id: creator},
                        success: function(response) {
                            console.log('Success Response:', response);
                            if (response.status="success") {
                                Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                                    .then((result) => {
                                        $('#actionModal').modal('hide');
                                        fetchData(event_id, query_type, function(data) {
                                            initializeDataTable(data.events);
                                        });
                                    });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                            var errorMessage = '<strong>skaiTick transaction request failed because:</strong>';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage += '<br>' + xhr.responseJSON.message;
                            } else {
                                errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                            }
                            Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                        }
                    });
                } else {
                    console.log("Delete action canceled by user.");
                }
            });
        }

        // Function to perform the "Suspend Event" action
        function suspendEventAction(id, title, creator) {
            var message = 'Are you sure you want to suspend this event? <strong>' + title + '</strong>';
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, suspend it',
                cancelButtonText: 'No, cancel',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route("events.suspend") }}',
                        data: {_token: '{{ csrf_token() }}',id: id, creator_id: creator},
                        success: function(response) {
                            console.log('Success Response:', response);
                            if (response.status="success") {
                                Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                                    .then((result) => {
                                        $('#actionModal').modal('hide');
                                        fetchData(event_id, query_type, function(data) {
                                            initializeDataTable(data.events);
                                        });
                                    });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                            var errorMessage = '<strong>skaiTick transaction request failed because:</strong>';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage += '<br>' + xhr.responseJSON.message;
                            } else {
                                errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                            }
                            Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                        }
                    });
                } else {
                    console.log("Delete action canceled by user.");
                }
            });
        }

        // Function to perform the "Verify Event" action
        function verifyEventAction(id, title) {
            var message = 'Are you sure you want to verify this event? <strong>' + title + '</strong>';
            Swal.fire({
                title: 'Confirm Action',
                html: message,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes, verify it',
                cancelButtonText: 'No, cancel',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route("events.verify") }}',
                        data: {_token: '{{ csrf_token() }}',id: id},
                        success: function(response) {
                            console.log('Success Response:', response);
                            if (response.status="success") {
                                Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                                    .then((result) => {
                                        $('#actionModal').modal('hide');
                                        fetchData(event_id, query_type, function(data) {
                                            initializeDataTable(data.events);
                                        });
                                    });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                            var errorMessage = '<strong>skaiTick transaction request failed because:</strong>';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage += '<br>' + xhr.responseJSON.message;
                            } else {
                                errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                            }
                            Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                        }
                    });
                } else {
                    console.log("Delete action canceled by user.");
                }
            });
        }

        // Event listener for the select dropdown change
        $('#modal-actions').on('change', function() {
            var selectedAction = $(this).val();
            var selectedOption = $(this).find(':selected');
            var id = $('#action-id').val()
            var title = $('#action-title').val();
            var creator = $('#action-creator').val();

            switch(selectedAction) {
                case 'more-details':
                    moreDetailsAction(id, title);
                    break;
                case 'modify-event':
                    modifyEventAction(id, title);
                    break;
                case 'event-ticket':
                    eventTicketAction(id, title);
                    break;
                case 'in-attendance':
                    inAttendanceAction(id, title);
                    break;
                case 'comments':
                    viewCommentsAction(id, title);
                    break;
                case 'likes':
                    whoLikedAction(id, title);
                    break;
                case 'stars':
                    viewStarsAction(id, title);
                    break;
                case 'viewers':
                    seeViewersAction(id, title);
                    break;
                case 'delete-record':
                    removeEventAction(id, title);
                    break;
                case 'view-author':
                    viewAuthorAction(id, title);
                    break;
                case 'subscribe-sms':
                    subscribeSmsAction(id, title);
                    break;
                case 'event-statistics':
                    eventStatisticsAction(id, title);
                    break;
                case 'aprove-event':
                    approveEventAction(id, title, creator);
                    break;
                case 'decline-event':
                    declineEventAction(id, title, creator);
                    break;
                case 'suspend-event':
                    suspendEventAction(id, title, creator);
                    break;
                case 'verify-event':
                    verifyEventAction(id, title);
                    break;
                default:
                    // Default action or error handling
                    console.log('Invalid action selected.');
                    break;
            }
        });


    });
</script>

@endsection

