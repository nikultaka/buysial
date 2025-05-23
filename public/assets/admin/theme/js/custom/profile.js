$(document).ready(function () {
    attachRemoveLogoHandler();

    if (!$('#img_privew').attr('src') || $('#img_privew').attr('src') === '#') {
        $("#img_privew").hide();
        $("#priview_image_title").hide();
    }

    $('#logo').on('change', function () {
        const [file] = this.files;
        if (file) {
            $("#img_privew").attr('src', URL.createObjectURL(file)).css({ height: '120px', width: 'auto' }).show();
            $("#priview_image_title").show();
        }
    });

    $('form[id="profileForm"]').validate({
        rules: {
            name: "required",
            email: { required: true, email: true },
            password: { minlength: 6 }
        },
        messages: {
            name: "This field is required",
            email: {
                required: "This field is required",
                email: "Please enter a valid email"
            },
            password: {
                minlength: "Password must be at least 6 characters"
            }
        },
        submitHandler: function () {
            const formData = new FormData($("#profileForm")[0]);
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

                            // Reset file input and hide preview
                            $('#logo').val('').hide();
                            $("#img_privew").hide();
                            $("#priview_image_title").hide();

                            if (data.user.logo) {
                                $('#logo-preview').remove(); // clear old preview

                                const html = `
                                    <div class="position-relative mb-2" id="logo-preview">
                                        <img src="${BASE_URL + '/' + data.user.logo}" alt="User Logo" width="100" class="border rounded">
                                        <button type="button" class="btn-close position-absolute top-0 start-100 translate-middle"
                                            aria-label="Remove" id="remove-logo-btn"
                                            style="background-color: red; opacity: 0.8;" data-logo="${data.user.logo}">
                                        </button>
                                    </div>
                                `;
                                $('#logo').after(html);
                                attachRemoveLogoHandler();
                            }
                        }

                        if (data.logout) {
                            setTimeout(() => window.location.href = BASE_URL + '/admin/logout', 1000);
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
                        let errorMsg = Object.values(xhr.responseJSON.errors).map(e => e[0]).join('<br>');
                        toastr.error(errorMsg);
                    } else {
                        toastr.error("An unexpected error occurred.");
                    }
                }
            });
        }
    });

    function attachRemoveLogoHandler() {
       $(document).off('click', '#remove-logo-btn').on('click', '#remove-logo-btn', function () {
            const logoPath = $(this).data('logo');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to remove the profile image?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
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
                                $('#logo').val('').show();
                                $("#img_privew").hide();
                                $("#priview_image_title").hide();
                            } else {
                                toastr.error(response.message || 'Failed to remove logo.');
                            }
                        },
                        error: function () {
                            $('#loader-container').hide();
                            toastr.error('An error occurred while removing the logo.');
                        }
                    });
                }
            });
        });
    }
});
