$(document).ready(function () {

    $(document).on('click', '#addcompany', function () {
        $('#companymodal').modal('show');
        $("#modal_title").html("");
        $("#modal_title").html("Add Company");
        $("#img").attr("required", true);
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


    $('form[id="companyForm"]').validate({
        rules: {
            company_logo: {
                extension: "jpg|jpeg|png|gif|svg|webp",
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
            }
        },
        messages: {
            company_logo: {
                extension: "Only image files are allowed."
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
            }
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

});
