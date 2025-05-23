@extends('admin.layouts.index')
@section('admin-title', 'Users')

@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-3">
            <div class="col-6">
                <h4 class="fw-bold">Users</h4>
            </div>
           
        </div>

        <div class="card p-2">
            <div class="row gy-3">
                <div class="col-lg-6 col-md-6">
                </div>
                <div class="col-lg-6 col-md-6">
                    <button type="button" class="btn btn-primary float-end mt-2 ms-2 mb-4" id="add-user-btn">
                        Add
                    </button>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table pt-2 " id="userTable">
                    <thead class="table-light  mt-3">
                        <tr class="text-nowrap">
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
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
                name: "Please enter the user name",
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
                            $('#userTable').DataTable().ajax.reload();
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
                        data: "action",
                        orderable: false
                    },
                ],
            });

            $(document).on('click', '#userEdit', function() {
                var id = $(this).data("id");
                $.ajax({
                    type: "GET",
                    url: "/admin/users/edit",
                    data: {
                        _token: $("[name='_token']").val(),
                        id: id,
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            if (response?.user_data) {
                                var userdata = response.user_data;
                                console.log("userdata:::", userdata)
                                $('#userModal').modal('show');
                                $("#userModalLabel").html("Edit User");

                                // Set form values
                                $('#hid').val(userdata?.id);
                                $('#name').val(userdata?.name);
                                $('#address').val(userdata?.address);
                                $('#phone').val(userdata?.phone);
                                $('#email').val(userdata?.email);
                                $("#zip").val(userdata?.zip);
                                $("#role").val(userdata?.role);
                                $('#dob').val(userdata?.date_of_birth);
                                $('#company').val(userdata?.company_id);
                                $('#userTable').DataTable().ajax.reload();
                                
                                $('#country').val(userdata?.country).change();
                                $('#country').val(userdata?.country).change();
                                // Load states based on selected country
                                $.ajax({
                                    url: 'get-states/' + userdata.country,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(states) {
                                        $('#state').html('<option value="">Select State</option>');
                                        $.each(states, function(index, state) {
                                            $('#state').append('<option value="' + state.id + '">' + state.name + '</option>');
                                        });

                                        // Set the state value and trigger change to load cities
                                        $('#state').val(userdata.state).change();

                                        // Load cities based on selected state
                                        $.ajax({
                                            url: 'get-cities/' + userdata.state,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(cities) {
                                                $('#city').html('<option value="">Select City</option>');
                                                $.each(cities, function(index, city) {
                                                    $('#city').append('<option value="' + city.id + '">' + city.name + '</option>');
                                                });

                                                // Set the city value once the cities are loaded
                                                $('#city').val(userdata.city);
                                            }
                                        });
                                    }
                                });
                            }
                        }
                    },
                });
            });


            
            $(document).on("click", "#userDelete", function () {
                let id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/admin/users/delete",
                            data: {
                                _token: $("[name='_token']").val(),
                                id: id,
                            },
                            success: function (response) {
                                var data = JSON.parse(response);
                                if (data.status == 1) {
                                    $('#userTable').DataTable().ajax.reload();
                                    toastr.success(data.message);
                                } else {
                                    toastr.error(data.message);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
