$(document).ready(function () {
    var validationRules = {
        name: "required",
        email: {
            required: true,
            email: true
        },
        password: {
            minlength: 6
        }
    };

    var validationMessages = {
        name: "This field is required",
        email: {
            required: "This field is required",
            email: "Please enter a valid email"
        },
        password: {
            minlength: "Password must be at least 6 characters"
        }
    };

    $('form[id="profileForm"]').validate({
        rules: validationRules,
        messages: validationMessages,
        submitHandler: function () {
            var formData = new FormData($("#profileForm")[0]);
            $('#loader-container').show();
            console.log("BASE_URL::",  BASE_URL + '/admin/profile/update');
            $.ajax({
                url: BASE_URL + '/admin/profile/update',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#loader-container').hide();

                    if (data.status == 'success') {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message || 'Update failed');
                    }

                    $("#profileForm")[0].reset();
                    $("#profileForm").validate().resetForm();
                    $("#profileForm").find('.error').removeClass('error');
                },
                error: function (xhr) {
                    $('#loader-container').hide();
                    if (xhr.status === 422) {
                        let errorMsg = Object.values(xhr.responseJSON.errors).map(
                            e => e[0]).join('<br>');
                        toastr.error(errorMsg);
                    } else {
                        toastr.error("An unexpected error occurred.");
                    }
                }
            });
        }
    });
});