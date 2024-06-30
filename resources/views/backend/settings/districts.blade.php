@extends('backend.layouts.app')

@section('title', 'List of Districts')

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
                        <div class="col-xxl-6 ms-auto">
                            <div>
                                <select id="filter2" class="select2 form-control">
                                    <option value="" selected>Filter by Region...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 ms-auto">
                            <div>
                                <select id="filter1" class="select2 form-control">
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
                                    <th>District</th>
                                    <th>Region</th>
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


<div class="modal fade modal-blur" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">..</h4>
            </div>
            <form id="my-form" method="post" action="save_data.php" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="gottenid" />
                    <div class="row g-9">

                        <div class="col-md-12 mb-2">
                            <label for="status" class="form-text">Provide your prefered District</label>
                            <input type="text" class="form-control" placeholder="eg. Menya Krobo East" id="district" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" required/>
                        </div>
                        <div class="col-md-12 fv-row">
                            <select id="region" class="select2 form-control mb-2" data-toggle="select2">
                            </select>
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
    $(document).ready(function ()
    {
        var dataTable = "";
        var counter = 0;

        // Getting data for the regions
        $.ajax({
            url: '{{ route("settings.regions.get") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#region').empty();
                $('#region').append($('<option>', {
                    value: '',
                    text: 'District is in what region...?',
                    selected: 'selected',
                    disabled: 'disabled'
                }));
                $.each(data.regions, function (key, value) {
                    $('#region').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });

        //calling the model to add new
        $('#btnNew').click(function() {
            $('#my-form')[0].reset();
            $('#state-view').hide();
            $('#edit-data').hide();
            $('#save-data').show();
            $('#region').val('').change();
            $('#modal-title').text('Add New Record');
            $('#my-modal').modal('show');
        });

        // Event listener for edit button
        $('#example').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var district = $(this).data('district');
            var region_id = $(this).data('region');
            var status = $(this).data('status');

            $('#modal-title').text('About to modify this record');
            $('#region').val(region_id).change();
            $('#district').val(district);
            $('#gottenid').val(id);
            $('#stat').val(status);
            $('#state-view').show();
            $('#save-data').hide();
            $('#edit-data').show();
            $('#my-modal').modal('show');

        });

        //Getting the table ready
        dataTable = $('#example').DataTable({
            ajax: {
                url: '{{ route("settings.districts.show") }}',
                dataSrc: 'districts'
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.name + '" />';
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return ++counter;
                    }
                },
                { data: 'name' },
                { data: 'region' },
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
                            '<a class="dropdown-item edit-btn" href="javascript: void(0);" data-id="' + data.id + '" data-district="' + data.name + '" data-region="' + data.region_id + '" data-status="' + data.status + '"><i class="mdi mdi-pen-plus mx-1"></i>Modify Record </a>' +
                            '<a class="dropdown-item text-danger delete-btn" href="javascript: void(0);" data-id="' + data.id + '" data-rol="' + data.name + '"><i class="mdi mdi-delete mx-1"></i>Remove Record</a>' +
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


                let uniqueStatusValues = dataTable.column(3).data().unique().toArray();
                let filter2 = document.getElementById("filter2");

                // Populate the remaining options
                uniqueStatusValues.forEach(function(value) {
                    let option = document.createElement("option");
                    option.value = value;
                    option.text = value;
                    filter2.appendChild(option);
                });

                let uniqueStatusValues1 = dataTable.column(4).data().unique().toArray();
                let filter1 = document.getElementById("filter1");

                // Populate the remaining options
                uniqueStatusValues1.forEach(function(value) {
                    let option = document.createElement("option");
                    option.value = value;
                    option.text = value;
                    filter1.appendChild(option);
                });
            }
        });

        //Filtering
        $('#filter2, #filter1').on('change', function () {
            var filter1 = $('#filter1').val();
            dataTable.column(4).search(filter1).draw();
            var filter2 = $('#filter2').val();
            dataTable.column(3).search(filter2).draw();
        });

        // Event listener for button click
        $('#bulk-remove').on('click', function () {
            var checkedCheckboxes = $('.select-checkbox:checked');
            if (checkedCheckboxes.length > 0) {
                let table='districts'
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
                        url: '{{ route("settings.bulk-remove") }}',
                        type: 'POST',
                        data: { id: selectedIds, table: table },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
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
                }
                else {
                    dataTable.ajax.reload();
                    $('#bulk-remove').fadeOut();
                }

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
            var districts = $('#district').val();
            var region_id = $('#region').val();

            // Check if fields are not empty
            if (!validateForm(districts, region_id)) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            $.ajax({
                type: 'POST',
                url: '{{ route("settings.districts.create") }}',
                data: {_token: '{{ csrf_token() }}',name: districts, region_id: region_id},
                success: function(response) {
                    console.log('Success Response:', response);
                    if (response.success) {
                        Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                            .then((result) => {
                                buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                                $('#my-form')[0].reset();
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
            var districts = $('#district').val();
            var region_id = $('#region').val();
            var stat = $('#stat').val();
            var gottenid = $('#gottenid').val();

            // Check if fields are not empty
            if (!validateForm(districts, stat,region_id, gottenid)) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr("disabled", true);

            $.ajax({
                type: "POST",
                url: '{{ route("settings.districts.update") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: districts, status: stat,district_id: gottenid, region_id:region_id
                },
                success: function(response) {
                    console.log('Success Response:', response);
                    if (response.status = "success") {
                        Swal.fire({ icon: 'success', title: 'Success',text: response.message,})
                            .then((result) => {
                                buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                                $('#my-form')[0].reset();
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
                        url: '{{ route("settings.districts.destroy") }}',
                        data: {_token: '{{ csrf_token() }}',district_id: ids},
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
                            var errorMessage = '<strong>Skai-Tick transaction request failed because:</strong>';
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

        $("#district").val("");
    });
</script>

@endsection

