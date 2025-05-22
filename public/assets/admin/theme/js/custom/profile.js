$(document).ready(function () {
    attachRemoveLogoHandler();
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

                    if (data.status === 'success') {
                        toastr.success(data?.message);

                        if (data.user) {
                            $('#profileForm input[name="name"]').val(data?.user?.name);
                            $('#profileForm input[name="email"]').val(data?.user?.email);
                            $('#profileForm input[name="password"]').val('');

                            // ✅ Update logo preview if exists
                            if (data.user.logo) {
                                let logoPreviewHtml = `
                                    <div class="mb-2 position-relative" id="logo-preview">
                                        <img src="${BASE_URL + '/' + data.user.logo}" alt="User Logo" width="100">
                                        <button 
                                            type="button" 
                                            class="btn-close position-absolute top-0 start-100 translate-middle" 
                                            aria-label="Remove" 
                                            id="remove-logo-btn" 
                                            style="background-color: red; opacity: 0.8;"
                                            data-logo="${data.user.logo}">
                                        </button>
                                    </div>
                                `;

                                // Remove file input and append preview
                                $('#logo').hide(); // hide input
                                $('#logo').after(logoPreviewHtml);
                                attachRemoveLogoHandler(); // Re-attach event handler
                            }
                        }

                        // If logout flag is true, redirect after short delay
                        if (data.logout) {
                            setTimeout(function () {
                                window.location.href = BASE_URL + '/admin/logout';
                            }, 1000);
                        }
                    } else {
                        toastr.error(data?.message || 'Update failed');
                    }

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

    // $('#remove-logo-btn').on('click', function () {
    //     if (!confirm('Are you sure you want to remove the logo?')) return;

    //     let logoPath = $(this).data('logo');

    //     $('#loader-container').show();

    //     $.ajax({
    //         url: BASE_URL + '/admin/profile/remove-logo',
    //         type: "POST",
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //             logo: logoPath
    //         },
    //         success: function (response) {
    //             $('#loader-container').hide();

    //             if (response.status === 'success') {
    //                 toastr.success(response.message);
    //                 $('#logo-preview').remove();
    //                 $('#logo').show();
    //             } else {
    //                 toastr.error(response.message || 'Failed to remove logo.');
    //             }
    //         },
    //         error: function () {
    //             $('#loader-container').hide();
    //             toastr.error('An error occurred while removing the logo.');
    //         }
    //     });
    // });

    function attachRemoveLogoHandler() {
        $('#remove-logo-btn').off('click').on('click', function () {
            if (!confirm('Are you sure you want to remove the logo?')) return;

            let logoPath = $(this).data('logo');

            $('#loader-container').show();

            $.ajax({
                url: BASE_URL + '/admin/profile/remove-logo',
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    logo: logoPath
                },
                success: function (response) {
                    $('#loader-container').hide();

                    if (response.status === 'success') {
                        toastr.success(response.message);

                        $('#logo-preview').remove();
                        $('#logo').val('').show(); // Show input again
                    } else {
                        toastr.error(response.message || 'Failed to remove logo.');
                    }
                },
                error: function () {
                    $('#loader-container').hide();
                    toastr.error('An error occurred while removing the logo.');
                }
            });
        });
    }
});