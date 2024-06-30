@extends('backend.layouts.app')

@section('title', 'Types of Events')

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
                                    <option value="" selected>Filter by Status...</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 ms-auto">
                            <div class="hstack gap-2">
                                <button type="button" id="btnref" class="btn btn-soft-secondary"><i class="mdi mdi-atom-letiant spin"></i> Reload</button>
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
        <div class="col-12">
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
                                    <th>Event</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Status</th>
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
                            <textarea id="description" class="form-control" rows="3"></textarea>
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

        //calling the model to add new
        $('#btnNew').click(function() {
            resetForm();
            $('#modal-title').text('Add New Record');
            $('#my-modal').modal('show');
            $('#state-view, #edit-data').hide();
            $('#save-data').show();
            $('#description').text('');
        });

        // Event listener for edit button
        $('#example').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var event = $(this).data('event');
            var price = $(this).data('price');
            var description = $(this).data('description');
            var status = $(this).data('status');

            $('#modal-title').text('About to modify this record');
            $('#event').val(event).change();
            $('#price').val(price);
            $('#gottenid').val(id);
            $('#description').text(description);
            $('#stat').val(status);
            $('#state-view').show();
            $('#save-data').hide();
            $('#edit-data').show();
            $('#my-modal').modal('show');

        });

        //Getting the table ready
        dataTable = $('#example').DataTable({
            ajax: {
                url: '{{ route("events.types.show") }}',
                dataSrc: 'events'
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.event + '" />';
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return ++counter;
                    }
                },
                { data: 'event' },
                { data: 'price' },
                {
                    data: 'description',
                    render: function(data, type, row) {
                        return data.length > 50 ? data.substring(0, 50) + '...' : data;
                    }
                },

                { data: 'status' },
                {
                    data: 'created_at',
                    render: function(data, type, row) {
                        return moment(data).format('YYYY-MM-DD hh:mm:ss A');
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return '<div class="btn-group">' +
                            '<button type="button" class="btn btn-outline-info waves-effect waves-light dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">' +
                            '<i class="mdi mdi-dots-horizontal font-16"></i> More' +
                            '<i class="mdi mdi-chevron-down"></i>' +
                            '</button>' +
                            '<div class="dropdown-menu">' +
                            '<span class="dropdown-header">More Actions</span>' +
                            '<hr style="margin-top: 1px;" />'+
                            '<a class="dropdown-item edit-btn" href="javascript: void(0);" data-id="' + data.id + '" data-event="' + data.event + '" data-price="' + data.price + '" data-description="' + data.description + '" data-status="' + data.status + '"><i class="mdi mdi-pen-plus mx-1"></i>Modify Record </a>' +
                            '<a class="dropdown-item text-danger delete-btn" href="javascript: void(0);" data-id="' + data.id + '" data-rol="' + data.event + '"><i class="mdi mdi-delete mx-1"></i>Remove Record</a>' +
                            '</div>' +
                            '</div>';
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


                let uniqueStatusValues = dataTable.column(5).data().unique().toArray();
                let filter2 = document.getElementById("filter2");

                // Populate the remaining options
                uniqueStatusValues.forEach(function(value) {
                    let option = document.createElement("option");
                    option.value = value;
                    option.text = value;
                    filter2.appendChild(option);
                });
            }
        });

        //Filtering
        $('#filter2').on('change', function () {
            var catFilter = $('#filter2').val();
            dataTable.column(5).search(catFilter).draw();
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

        // FUnction to validate the inputs before
        function validateForm(...fields) {
            for (let field of fields) {
                if (!field) {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Please fill in all fields.' });
                    return false;
                }
            }
            return true;
        }


        // Save Data Button Click Event
        $('#save-data').on('click', function() {
            var event = $('#event').val();
            var price = $('#price').val();
            var des = $('#description').val();

            // Check if fields are not empty
            if (!validateForm(event, description)) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                type: 'POST',
                url: '{{ route("events.types.create") }}',
                data: {_token: '{{ csrf_token() }}',event: event, price: price, description: des,},
                success: function(response) {
                    console.log('Success Response:', response);
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                            .then((result) => {
                                buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                                $('#my-form')[0].reset();
                                resetForm();
                                $('#my-modal').modal('hide');
                                counter = 0; dataTable.ajax.reload();
                            });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    var errorMessage = '<strong>Skai-Tick transaction request failed because:</strong>';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage += '<br>' + xhr.responseJSON.message;
                    } else {
                        errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                    }
                    Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                }

            });
        });

        // Edit Data Button Click Event
        $('#edit-data').on('click', function() {
            var event = $('#event').val();
            var price = $('#price').val();
            var des = $('#description').val();
            var stat = $('#stat').val();
            var gottenid = $('#gottenid').val();

            // Check if fields are not empty
            if (!validateForm(event, description, stat, gottenid)) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr("disabled", true);

            $.ajax({
                type: "POST",
                url: '{{ route("events.types.update") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    event: event,description: des, price: price, status: stat, event_id: gottenid
                },
                success: function(response) {
                    console.log('Success Response:', response);
                    if (response.status="success") {
                        Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                            .then((result) => {
                                buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                                $('#my-form')[0].reset();
                                resetForm();
                                $('#my-modal').modal('hide');
                                counter = 0; dataTable.ajax.reload();
                            });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    var errorMessage = '<strong>Skai-Tick transaction request failed because:</strong>';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage += '<br>' + xhr.responseJSON.message;
                    } else {
                        errorMessage += '<br>' + textStatus + ', ' + errorThrown;
                    }
                    Swal.fire({ icon: 'error', title: 'Error', html: errorMessage });
                }
            });
        });

        // Event listener for delete button
        $('#example').on('click', '.delete-btn', function(e) {
            var ids = $(this).data('id');
            var rol = $(this).data('rol');
            var message = 'Are you sure you want to remove this record? <strong>' + rol + '</strong>';
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
                        data: {_token: '{{ csrf_token() }}',event_id: ids},
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
        });

        $("#role").val("");   //resetting the event

    });
</script>

@endsection

