$(document).ready(function () {

    $(document).on('click', '#addcompany', function () {
        $('#companymodal').modal('show');
        $("#modal_title").html("");
        $("#modal_title").html("Add Company");
        $("#company_logo").attr("required", true);
        $("#modal_title").html("Add Company");
    });

    $("#companymodal").on("hidden.bs.modal", function () {
        $("#imgHid").val("");
        $("#companyForm")[0].reset();
        $("#hid").val("");
        $("#companyForm").validate().resetForm();
        $("#companyForm").find('.error').removeClass('error');
        $("#oldimgbox").hide();
        $("#img_privew").hide();
        $("#priview_image_title").hide();
    });

    let list = $('#companyTable').dataTable({
        searching: true,
        paging: true,
        pageLength: 10,

        "ajax": {
            url: BASE_URL + "/admin/companylist",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
        },
        columns: [{
            data: "id",
            name: "id"
        },
        {
            data: "company_name",
            name: "company_name"
        },
        {
            data: "company_code",
            name: "company_code"
        },
        {
            data: "company_email",
            name: "company_email"
        },
        {
            data: "company_phone",
            name: "company_phone"
        },
        {
            data: "company_address",
            name: "company_address"
        },
        {
            data: "status",
            name: "status",
        },
        {
            data: "action",
            name: "action",
            orderable: false
        },
        ],
    });

    // Add custom validation method for file size
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'File size must be less than {0} bytes');

    // Add image preview functionality
    $("#company_logo").change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#img_privew").attr("src", e.target.result);
                $("#priview_image_title").show();
                $("#oldimgbox").hide();
            }
            reader.readAsDataURL(file);
        }
    });

    // Close preview image
    $("#close_icone").click(function() {
        $("#company_logo").val("");
        $("#img_privew").attr("src", "");
        $("#priview_image_title").hide();
        $("#oldimgbox").show();
    });

    $('form[id="companyForm"]').validate({
        rules: {
            company_logo: {
                extension: "jpg|jpeg|png|gif|webp",
                filesize: 5242880 // 5MB in bytes
            },
            company_name: {
                required: true
            },
            company_code: {
                required: true
            },
            company_email: {
                required: true,
                email: true
            },
            company_phone: {
                required: true,
                digits: true
            },
            company_address: {
                required: true
            },
            company_city: {
                required: true
            },
            company_state: {
                required: true
            },
            company_zip: {
                required: true
            },
            company_country: {
                required: true
            },
            company_website: {
                url: true
            },
            status: {
                required: true
            },
        },
        messages: {
            company_logo: {
                extension: "Only image files are allowed.",
                filesize: "File size should be less than 5MB."
            },
            company_name: {
                required: "Company name is required."
            },
            company_code: {
                required: "Company code is required."
            },
            company_email: {
                required: "Email is required.",
                email: "Please enter a valid email."
            },
            company_phone: {
                required: "Phone number is required.",
                digits: "Only digits are allowed."
            },
            company_address: {
                required: "Address is required."
            },
            company_city: {
                required: "City is required."
            },
            company_state: {
                required: "State is required."
            },
            company_zip: {
                required: "ZIP code is required."
            },
            company_country: {
                required: "Country is required."
            },
            company_website: {
                url: "Please enter a valid URL."
            },
            status: {
                required: "Please select status."
            },
        },
        submitHandler: function () {
            var formData = new FormData($("#companyForm")[0]);
            $('#loader-container').show();

            $.ajax({
                url: BASE_URL + '/admin/company/save',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data?.status == 1) {
                        toastr.success(data.message);
                        $('#companymodal').modal('hide');
                    } else {
                        toastr.error(data.message);
                    }

                    $('#loader-container').hide();
                    $('#companyTable').DataTable().ajax.reload();

                    $("#companyForm")[0].reset();
                    $("#companyForm").validate().resetForm();
                    $("#companyForm").find('.error').removeClass('error');
                }
            });
        }
    });


    $(document).on("click", "#companyDelete", function () {
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
                    url: "/admin/company/delete",
                    data: {
                        _token: $("[name='_token']").val(),
                        id: id,
                    },
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.status == 1) {
                            $('#companyTable    ').DataTable().ajax.reload();
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            }
        });
    });


    $(document).on("click", "#companyEdit", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: BASE_URL + "/admin/company/edit",
            data: {
                id: id
            },
            success: function (response) {
                if (response?.status === 1) {
                    const data = response.companydata;
                    $('#companymodal').modal('show');
                    $("#hid").val(data.id);
                    $("#company_name").val(data.company_name);
                    $("#company_code").val(data.company_code);
                    $("#company_email").val(data.company_email);
                    $("#company_phone").val(data.company_phone);
                    $("#company_address").val(data.company_address);
                    $("#company_city").val(data.company_city);
                    $("#company_state").val(data.company_state);
                    $("#company_zip").val(data.company_zip);
                    $("#company_country").val(data.company_country);
                    $("#company_website").val(data.company_website);
                    $("#status").val(data.status == 'Active' ? 1 : 0);

                    // Handle existing image
                    if (data.company_logo) {
                        $("#oldimgbox").show();
                        $("#imgbox").html(`<img src="${BASE_URL}/uploads/companies/${data.company_logo}" alt="Company Logo" style="height: 120px; width: auto; margin-top: 10px; border-radius: 5px;">`);
                    } else {
                        $("#oldimgbox").hide();
                    }
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
});
