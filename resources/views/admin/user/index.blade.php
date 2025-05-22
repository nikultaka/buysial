@extends('admin.layouts.index')
@section('admin-title', 'Users')

@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="fw-bold">Users</h4>
            </div>
            <div class="col-6 text-end">
                <button class="btn btn-primary" id="add-user-btn">
                    <i class="bx bx-plus me-1"></i> Add User
                </button>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">User List</h5>
            <div class="table-responsive text-nowrap">
                <table id="userTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Birth Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('admin.user.modal')
@endsection

@section('admin-footer')
    <script>
        $(document).ready(function() {
            $('#add-user-btn').on('click', function() {
                $('#userModal').modal('show');
            });

            $('#cancel-user-btn').on('click', function() {
                $('#userModal').modal('hide');
            });

            var validationRules = {
                name: "required",
                "role[]": {
                    required: true
                },
                address: "required",
                country: "required",
                city: "required",
                state: "required",
                zip: {
                    required: true,
                    maxlength: 6,
                    minlength: 5,
                    digits: true, 
                },
                phone: {
                    required: true,
                    digits: true, 
                    minlength: 10,
                    maxlength: 10,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: function() {
                        return $('#hid').val() === "";
                    },

                    minlength: 8,
                    pattern: /^(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/,
                },
                date_of_birth: "required",
            };

            var validationMessages = {
                name: "Please enter the staff name",
                "roles[]": "Please select at least one role",
                address: "Please enter the address",
                country: "Please select a country",
                city: "Please enter the city",
                state: "Please enter the state",
                zip: {
                    required: "Please enter the ZIP code",
                    maxlength: "ZIP code cannot be more than 6 digits",
                    minlength: "ZIP code must be at least 5 digits",
                    digits: "ZIP code must contain only numbers",
                },
                phone: {
                    required: "Please enter the phone number",
                    digits: "Phone number must contain only numbers",
                    minlength: "Phone number must be exactly 10 digits",
                    maxlength: "Phone number must be exactly 10 digits",
                },
                email: {
                    required: "Please enter the email address",
                    email: "Please enter a valid email address",
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long",
                    pattern: "Password must contain at least one special character",
                },
                date_of_birth: "Please select the birth date",
            };

            $('form[id="userForm"]').validate({
                rules: validationRules,
                messages: validationMessages,
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "role[]") {
                        error.appendTo("#role-error");
                    } else {
                        error.insertAfter(element);
                    }
                },

                submitHandler: function() {
                    var formData = new FormData($("#userForm")[0]);
                    $('#loader-container').show();
                    $.ajax({
                        url: BASE_URL + '/admin/users/save',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(data) {
                            if (data && Object.keys(data).length > 0) {
                                if (data.status == 1) {
                                    toastr.success(data.message);
                                    $('#loader-container').hide();
                                    $('#userModal').modal('hide');
                                } else {
                                    toastr.error(data.message);
                                    $('#loader-container').hide();
                                }
                            }
                            $("#userForm")[0].reset();
                            $("#userForm").validate().resetForm();
                            $("#userForm").find('.error').removeClass('error');
                            $('#StaffTable').DataTable().ajax.reload();
                            $('#per_details_tab').load(window.location.href + ' #per_details_tab');
                        }
                    });
                },
            });
            
            $('#country').on('change', function() {
                var countryId = $(this).val();
                $('#state').html('<option value="">Loading...</option>'); 
                $('#city').html('<option value="">Select City</option>');

                if (countryId) {
                    $.ajax({
                        url: BASE_URL + '/admin/get-states/'  + countryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(states) {
                            $('#state').html('<option value="">Select State</option>');
                            $.each(states, function(index, state) {
                                $('#state').append('<option value="' + state?.id + '">' + state?.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#state').html('<option value="">Select State</option>'); 
                }
            });

            $('#state').on('change', function() {
                var stateId = $(this).val();
                $('#city').html('<option value="">Loading...</option>'); // Show loading text

                if (stateId) {
                    $.ajax({
                        url: 'get-cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(cities) {
                            $('#city').html('<option value="">Select City</option>');
                            $.each(cities, function(index, city) {
                                $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city').html('<option value="">Select City</option>'); // Reset city if no state selected
                }
            });


            if ($.fn.DataTable.isDataTable('#userTable')) {
                $('#userTable').DataTable().destroy();
            }

            $('#userTable').dataTable({
                searching: true,
                paging: true,
                pageLength: 10,

                "ajax": {
                    url: "/admin/users/userList",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: $("[name='_token']").val(),
                    },
                },
                columns: [{
                        data: "name",
                    },
                    {
                        data: "roles",
                    },
                    {
                        data: "email",
                    },
                    {
                        data: "phone",
                    },
                    {
                        data: "address",
                    },
                    {
                        data: "date_of_birth",
                    },
                    {
                        data: "action",
                        orderable: false
                    },
                ],
            });
        });
    </script>
@endsection
