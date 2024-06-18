@extends('backend.layouts.app')

@section('title', 'My Events')

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
                <h4 class="page-title"><i class="mdi mdi-briefcase me-1"></i> @yield('title')</h4>
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
                        <div class="col-xxl-5 ms-auto">
                            <div>
                                <select id="filter3" class="select2 form-control" >
                                    <option value="" selected>Filter by event type...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-4 ms-auto">
                            <div>
                                <select id="filter2" class="select2 form-control" >
                                    <option value="" selected>Filter by Status...</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 ms-auto">
                            <div class="hstack gap-2">
                                <button type="button" id="btnref" class="btn btn-soft-secondary">Reload</button>
                                <button type="button" id="btnNew" class="btn btn-outline-success waves-effect waves-light"><i class="mdi mdi-briefcase me-1"></i> Create New Event</button>
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
                        <div class="col-sm-5">
                            <button class="btn btn-danger" type="button" id="bulk-remove" style="display: none" > Remove Selected</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllCheckboxes"/></th>
                                    <th>#</th>
                                    <th>Event Title</th>
                                    <th>Event Type</th>
                                    <th>Views</th>
                                    <th>Likes</th>
                                    <th>Comments</th>
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
                            <option value="subscribe-sms">Subscribe SMS</option>
                            <option value="delete-record">Remove Event</option>
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

@php
    $hostId = session('host');
@endphp

<div class="modal fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">..</h4>
            </div>
            <form id="my-form" method="post" action="save_data.php" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="gottenid" />
                    <div class="row" style="height: 400px; overflow-y: scroll;">

                        <div class="col-md-12">
                            <div class="form-outline mb-1">
                                <div class="form">
                                    <label for="email">Event title</label>
                                    <input type="text" id="title" class="form-control" placeholder="Event main title here">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-outline mb-1">
                                <div class="form">
                                    <label for="email">Sub title</label>
                                    <input type="text" id="sub_title" class="form-control" placeholder="Event sub title here">
                                </div>
                            </div>
                        </div>

                        <div class="contact-form">
                            <div class="form-outline col-md-12 mb-1">
                                <textarea id="contents" class="form-control" rows="3"  name="message" placeholder="What content do you want to show to viewers"></textarea>
                            </div>
                            <div class="form-outline mb-1">
                                <textarea id="discription" class="form-control" rows="3"  name="message" placeholder="Describe your event not more than 500 words"></textarea>
                            </div>
                            <div class="form-outline mb-1">
                                <textarea id="reason" name="message" class="form-control" rows="3" placeholder="Give a comprehensive reason for creating the event it is required..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="gender">Event type</label>
                                <select id="event_type" name="select" class="form-control select2">
                                    <option value="" disabled selected>Choose option...</option>
                                </select>
                        </div>
                        <div class="col-md-6">
                            <label for="shortBy">Alaises (15 Characters long)</label>
                            <input class="form-control" type="text" id="event_initials" placeholder="eg. VGMA24 or Emy Awards" maxlength="15">
                        </div>

                        <div class="col-md-6">
                            <label for="shortBy">Starting date</label>
                            <input type="date" id="start_date" class="form-control" placeholder="Select Date">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="shortBy">Ending date</label>
                            <input type="date" id="end_date" class="form-control" placeholder="Select Date">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="shortBy">Venue: (where is the event happening)</label>
                            <input type="text" id="venue" class="form-control" placeholder="eg. Accra-National Theatre">
                        </div>

                        <div class="col-md-12 mb-1">
                            <label for="banner">Upload Banner (1920 by 1000 px Landscape image)</label>
                            <input type="file" id="banner" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="large_image">Upload the large image (1500 by 1500 px Portrait)</label>
                            <input type="file" id="large_image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="medium_image">Upload the main image (1080 by 1080 px Square image)</label>
                            <input type="file" id="medium_image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-12">
                            <label for="small_image">Upload small image (900 by 900 px Square image)</label>
                            <input type="file" id="small_image" class="form-control" accept="image/*">
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
    }


    $(document).ready(function ()
    {
        var dataTable = "";
        var counter = 0;
        var hostId = "{{ $host }}";


        //calling the model to add new
        $('#btnNew').click(function() {

            function generateGUIDs() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            }

            var prefs = generateGUIDs().replace(/-/g, '').substring(0, 30);
            var surfs = generateGUIDs().replace(/-/g, '').substring(10, 20);
            var combinedUrl = prefs + '~' + hostId + '!' + surfs;
            // alert(combinedUrl);

            var routeUrls = "{{ route('events.setting-up', ['id' => '__ID__']) }}".replace('__ID__', combinedUrl);
            window.location.href = routeUrls;
        });


        // Getting data for the event type
        $.ajax({
            url: '{{ route('events.types.get') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#event_type').empty();
                $('#event_type').append($('<option>', {
                    value: '',  text: 'Choose option...', selected: 'selected', disabled: 'disabled'
                }));
                $.each(data.types, function(key, value) {
                    $('#event_type').append($('<option>', {
                        value: value.id,
                        text: value.event,
                        'data-prices': value.price
                    }));
                });
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });


        //Getting the table ready
        dataTable = $('#example').DataTable({
            ajax: {
                url: '{{ route("events.show") }}',
                dataSrc: 'events'
            },
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
                { data: 'likes' },
                { data: 'comments' },
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
                    $('#bulk-remove').toggle(isChecked);
                });


                let uniqueStatusValues2 = dataTable.column(7).data().unique().toArray();
                let filter2 = document.getElementById("filter2");

                let uniqueStatusValues3 = dataTable.column(3).data().unique().toArray();
                let filter3 = document.getElementById("filter3");

                // Populate the remaining options
                uniqueStatusValues2.forEach(function(value) {
                    let option = document.createElement("option");
                    option.value = value;
                    option.text = value;
                    filter2.appendChild(option);
                });
                uniqueStatusValues3.forEach(function(value) {
                    let option = document.createElement("option");
                    option.value = value;
                    option.text = value;
                    filter3.appendChild(option);
                });
            }
        });

        // Calling action modal
        $('#example').on('click', '.btn-action', function() {
            var id = $(this).data('id');
            var event = $(this).data('event');
            $('#action-id').val(id);
            $('#action-title').val(event);

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

        //Filtering
        $('#filter2, #filter3').on('change', function () {
            var filter2 = $('#filter2').val();
            dataTable.column(7).search(filter2).draw();
            var filter3 = $('#filter3').val();
            dataTable.column(3).search(filter3).draw();
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
            $('#bulk-remove').toggle(anyCheckboxChecked);
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
            function generateGUID() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            }

            var pref = generateGUID().replace(/-/g, '').substring(0, 30);
            var surf = generateGUID().replace(/-/g, '').substring(10, 20);
            var combinedId = pref + '%' + id + '!' + surf;

            var routeUrl = "{{ route('events.tickets.show', ['id' => '__ID__']) }}".replace('__ID__', combinedId);
            window.location.href = routeUrl;
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

        // Function to perform the "Event Statistics" action
        function eventStatisticsAction(id, title) {
            console.log('Performing Event Statistics action for ID:', id, 'with title:', title);
            // Your code to perform the "Event Statistics" action goes here
        }


        // Event listener for the select dropdown change
        $('#modal-actions').on('change', function() {
            var selectedAction = $(this).val();
            var selectedOption = $(this).find(':selected');
            var id = $('#action-id').val()
            var title = $('#action-title').val();

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
                case 'subscribe-sms':
                    subscribeSmsAction(id, title);
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

