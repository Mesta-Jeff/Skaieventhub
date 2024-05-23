@extends('backend.layouts.app')

@section('title', 'Users List')

@section('additional-css')
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Start Content-->

    <style>

		img {
		  	display: block;
		  	max-width: 100%;
		}

		.preview {
  			overflow: hidden;
  			width: 140px;
  			height: 140px;
  			margin: 10px;
  			border: 2px solid teal;
		}
	</style>

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
                        <div class="col-xxl-3 ms-auto">
                            <div>
                                <select id="filter2" class="select2 form-control">
                                    <option value="" selected>Filter by Status...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 ms-auto">
                            <div>
                                <select id="filter1" class="select2 form-control">
                                    <option value="" selected>Filter by Role...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 ms-auto">
                            <div>
                                <select id="filter3" class="select2 form-control">
                                    <option value="" selected>Filter by Location...</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-xxl-3 ms-auto">
                            <div class="hstack gap-2">
                                <button type="button" id="btnref" class="btn btn-secondary"><i class="mdi mdi-atom-letiant spin"></i> Reload</button>
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
                                    <th>Role</th>
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


<div class="modal fade" id="my-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" id="memberid-input" class="form-control" value="">
                        <form id="my-form" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="gottenid"/>
                            <div class="text-center mb-4 mt-n5 pt-2" style="back">
                                <div class="d-inline-block">
                                    <img id="image-preview" class="img-fluid img-thumbnail" style="display: none;">
                                </div>
                                <div class="row mt-4 tables">
                                    <div class="col-md-12 mb-2">
                                        <input type="file" class="form-control" id="upload_image" accept="image/*" style="display: none;">
                                        <button class="btn btn-outline-secondary rounded-4" id="load-image"><i class="mdi mdi-upload"></i>Upload Image</button>
                                    </div>
                                </div>
                            </div>
                            <div id="form-body" class="modal-body py-1" style="margin-top: -25px; max-height: 400px; overflow-y: auto;">
                                <div class="row g-9 mb-7">
                                    <div class="col-md-12 mb-2">
                                        <label for="status" class="form-text">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="eg. 0245482029" name="phone" id="phone" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10" required/>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="status" class="form-text">Provide your fullname</label>
                                        <input type="text" class="form-control" placeholder="eg. Solomon Nana Ayisi Jeff" id="username" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" required/>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="status" class="form-text">How do you want us to addres you, <code>the name must have either (underscore or hyphen)</code></label>
                                        <input type="text" class="form-control" placeholder="eg. Messta-Jeff" id="nickname" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" maxlength="15" required/>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="text" class="form-control" placeholder="Email Address" id="secrete" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" onkeypress="if(event.keyCode && event.keyCode >= 65 && event.keyCode <= 90) event.preventDefault();" required/>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="status" class="form-text">User Password</label>
                                        <input type="password" class="form-control" placeholder="Provide Password" id="password" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" required/>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="status" class="form-text">Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Provide Password" id="confirm-password" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" required/>
                                        <div class="text-danger" id="password-error" style="display: none">Password is incorrect....</div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="status" class="form-text">Select Gender</label>
                                        <select class="select2 form-control" data-placeholder="Select Gender" id="gender" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="status" class="form-text">Provide Date of birth</label>
                                        <input type="date" id="dob" name="dob" class="form-control"/>
                                    </div>
                                    <div class="col-md-12 mb-2" id="controllers">
                                        <label for="status" class="form-text">You must assign the user a role</label>
                                        <select class="select2 form-control" id="role" name="role" data-placeholder="Select Role" required></select>
                                    </div>
                                    <div class="col-md-12 mb-2" id="anonymous-fear">
                                        <label for="status" class="form-text">What is your greatest fear...? Will use this to verify you when your account is hacked, <code> an must not contain whitespace nor uppercase</code></label>
                                        <input type="text" class="form-control" placeholder="eg.#thefearofladies" id="fear" onselectstart="return false" onpaste="return false;" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete="off" required/>
                                    </div>
                                    <div class="mb-1" style="display: none;" id="state-view">
                                        <label for="status" class="form-text">Select Status</label>
                                        <select class="form-control" name="stat" id="stat">
                                            <option value="Active">Active</option>
                                            <option value="InActive">InActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer flex-center">
                                <button type="reset" id="btnClear" class="btn btn-secondary btn-sm">Clear Input</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="save-data" class="btn btn-success btn-sm">Proceed</button>
                                <button type="button" id="edit-data" class="btn btn-primary btn-sm">Proceed</button>
                                <button type="button" id="edit-images" class="btn btn-primary btn-sm">Confirm Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imge-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop" class="btn btn-primary">Crop</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



@section('additional-js')
    <script src="{{ asset('root/vez/assets/js/pages/team.init.js') }}"></script>
@endsection

<script src="{{ asset('root/dek/bower_components/jquery/js/jquery.min.js') }}"></script>
<script src="https://unpkg.com/cropperjs"></script>

<script>

    $(document).ready(function ()
    {
        var dataTable = "";
        var counter = 0;

        var $modal = $('#imge-modal');
        var image = document.getElementById('sample_image');
        var cropper;
        var converted_dob;
        var address;

        //PICTURE CHANGE
        $('#load-image').click(function () {
            $('#upload_image').click();
        });

        $('#upload_image').change(function (event) {
            const fileInput = $(this);
            const file = event.target.files?.[0];
            if (!file) {
                showAlert('Error', 'Please select an image file.');
                fileInput.val(null);
                $('#image-preview').attr('src', null);
                return;
            }
            if (!file.type.startsWith('image/') || file.size > 2 * 1024 * 1024) {
                showAlert('Error', 'Please select a valid image file (e.g., jpeg, png, jpg) within 2MB.');
                fileInput.val(null);
                $('#image-preview').attr('src', null);
                return;
            }
            const reader = new FileReader();
            reader.onload = () => {
                image.src = reader.result;
                $modal.modal('show');
            };
            reader.readAsDataURL(file);
        });

        //CALLING THE CROPPING MODAL
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview:'.preview'
            });
            }).on('hidden.bs.modal', function(){
                cropper.destroy();
                cropper = null;
        });

        //function to crop the selected image
        $('#crop').click(function(){

            var requiredWidth = 35;
            var requiredHeight = 45;

            var pixelsPerMM = 3;
            var widthInPixels = requiredWidth * pixelsPerMM;
            var heightInPixels = requiredHeight * pixelsPerMM;

            canvas = cropper.getCroppedCanvas({
                width: widthInPixels,
                height: heightInPixels
            });

            canvas.toBlob(function(blob){
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function(){
                    var base64data = reader.result;
                    $('#image-preview').attr('src', base64data);
                    $('#image-preview').show();
                    $modal.modal('hide');
                };
            });
        });

        // Converting the dob
        $('#dob').change(function() {
            var selectedDate = $(this).val();
            if (selectedDate) {
                var date = new Date(selectedDate);
                var formattedDate = date.toISOString().split('T')[0];
                converted_dob = formattedDate;
            }
        });

        // Validating the fear
        $('#fear').on('input', function() {
            var value = $(this).val();
            value = value.replace(/\s+/g, '');
            if (!value.startsWith('#')) {
                value = '#' + value.replace(/^#+/, '');
            }
            value = value.toLowerCase();
            $(this).val(value);
        });

        // Password confirmation
        $('#confirm-password').on('input', function() {
            var password = $('#password').val();
            var confirmPassword = $(this).val();
            var passwordError = $('#password-error');
            if (password !== confirmPassword) {
                passwordError.show();
            } else {
                passwordError.hide();
            }
        });

        // Getting data for the roles
        $.ajax({
            url: '{{ route("settings.roles.fetch") }}',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#role').empty();
                $('#role').append($('<option>', {
                    value: '',
                    text: '--- Select an option ---',
                    selected: 'selected',
                    disabled: 'disabled'
                }));
                $.each(data.roles, function (key, value) {
                    $('#role').append($('<option>', {
                        value: value.id,
                        text: value.title
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
            $('#edit-images').hide();
            $('#my-modal').modal('show');
        });

        // Event listener for edit button
        $('#example').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var role = $(this).data('role');
            var description = $(this).data('description');
            var status = $(this).data('status');

            $('#modal-title').text('About to modify this record');
            $('#role').val(role).change();
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
                url: '{{ route("settings.roles.show") }}',
                dataSrc: 'roles'
            },
            columns: [
                {
                    data: null,
                    render: function (data, type, row) {
                        return '<input type="checkbox" class="select-checkbox" data-id="' + data.id + '" data-title="' + data.title + '" />';
                    },
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return ++counter;
                    }
                },
                { data: 'title' },
                { data: 'description' },
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
                            '<a class="dropdown-item edit-btn" href="javascript: void(0);" data-id="' + data.id + '" data-role="' + data.title + '" data-description="' + data.description + '" data-status="' + data.status + '"><i class="mdi mdi-pen-plus mx-1"></i>Modify Record </a>' +
                            '<a class="dropdown-item text-danger delete-btn" href="javascript: void(0);" data-id="' + data.id + '" data-rol="' + data.title + '"><i class="mdi mdi-delete mx-1"></i>Remove Record</a>' +
                            '<a class="dropdown-item" href="javascript: void(0);">Add Star</a>' +
                            '<a class="dropdown-item" href="javascript: void(0);">Mute</a>' +
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
                return { extend: type, className: "btn btn-outline-success waves-effect waves-light" };
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


                let uniqueStatusValues = dataTable.column(4).data().unique().toArray();
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
            dataTable.column(4).search(catFilter).draw();
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
            dataTable.ajax.reload();
            // window.location.reload();
        })

        // FUnction to validate the inputs before
        function validateForm(password, confirmPassword, phone, username, nickname, email, gender, dob, role, fear) {
            if (!password || !confirmPassword || !phone || !username || !nickname || !email || !gender || !dob || !role || !fear) {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Please fill in all fields.' });
                return false;
            }
            if (password !== confirmPassword) {
                Swal.fire({ icon: 'error', title: 'Attention Please', text: "Please check your password mismatch" });
                return false;
            }
            return true;
        }

        // Gett user information
        $.get("https://ipinfo.io", function(response) {
            address = response.country + ", " + response.region+ " " + response.city
            console.log('City:', address);
        }, "json");

        // Save Data Button Click Event
        $('#save-data').on('click', function (e) {
            var base64data = $('#image-preview').attr('src').split(',')[1];
            var blob = b64toBlob(base64data, 'image/png');

            var password = $('#password').val();
            var confirmPassword = $('#confirm-password').val();
            var phone = $('#phone').val();
            var username = $('#username').val();
            var nickname = $('#nickname').val();
            var emailValue = $('#secrete').val();
            var gender = $('#gender').val();
            var dob = $('#dob').val();
            var role = $('#role').val();
            var fear = $('#fear').val();

            if (!validateForm(password, confirmPassword, phone, username, nickname, emailValue, gender, dob, role, fear)) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr('disabled', true);

            var formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('phone', phone);
            formData.append('name', username);
            formData.append('nickname', nickname);
            formData.append('email', emailValue);
            formData.append('password', password);
            formData.append('gender', gender);
            formData.append('dob', converted_dob);
            formData.append('role_id', role);
            formData.append('fear', fear);
            formData.append('address', address);
            formData.append('image', blob);

            $.ajax({
                type: 'POST',
                url: '{{ route("users.create") }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log('Success Response:', response);
                    if (response && response.success) {
                        Swal.fire({ icon: 'success', title: 'Success', text: response.message })
                            .then((result) => {
                                buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                                $('#my-form')[0].reset();
                                $('#my-modal').modal('hide');
                                counter = 0;
                                dataTable.ajax.reload();
                            });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: response && response.message ? response.message : 'Unknown error occurred.' });
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    buttonElement.prop('disabled', false).text('Proceed').css('cursor', 'pointer');
                    var errorMessage = '<strong>skaiHUB transaction request failed because:</strong>';
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
            var roles = $('#role').val();
            var des = $('#description').val();
            var stat = $('#stat').val();
            var gottenid = $('#gottenid').val();

            // Check if fields are not empty
            if (!validateForm(roles, description, stat, gottenid)) return;

            var buttonElement = $(this);
            buttonElement.html('<i class="fa fa-spinner fa-spin"></i> Please wait... ').attr("disabled", true);

            $.ajax({
                type: "POST",
                url: '{{ route("settings.roles.update") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: roles,description: des, status: stat,role_id: gottenid
                },
                success: function(response) {
                    console.log('Success Response:', response);
                    if (response.status="success") {
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
                    var errorMessage = '<strong>skaiHUB transaction request failed because:</strong>';
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
                        url: '{{ route("settings.roles.destroy") }}',
                        data: {_token: '{{ csrf_token() }}',role_id: ids},
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
                            var errorMessage = '<strong>skaiHUB transaction request failed because:</strong>';
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

        $("#role").val("");   //resetting the roles

    });

    //Showing universal message
    function showAlert(title, message) {
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
        });
    }

    // Function to convert base64 to Blob
    function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }

        var blob = new Blob(byteArrays, { type: contentType });
        return blob;
    }

</script>

@endsection

