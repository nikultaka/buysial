@extends('admin.layouts.index')
@section('admin-title', 'General Setting')

@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <h5 class="card-header">General Setting</h5>
                    <div class="card-body">
                        <form id="general_setting_form" name="general_setting_form" onsubmit="return false" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                {{-- Logo --}}
                                <label for="logo" class="form-label">Logo</label>
                                <div class="mb-3">
                                    @if (!empty(get_setting('logo')))
                                        <div class="logo-preview" style="height: auto;">
                                            <img src="{{ asset('logos/' . get_setting('logo')) }}" alt="logo"
                                                id="logo-preview-img" width="100">
                                            <a href="javascript:void(0)" id="remove-logo"
                                                style="float:right; color:grey;">X</a>
                                        </div>
                                    @endif

                                    <div class="after_remove_logo">
                                        <input class="form-control" type="file" id="logo" name="logo"
                                            onchange="previewImage(this, '#logo-preview')">
                                        <img id="logo-preview" src="#" alt="Logo Preview"
                                            style="display: none; max-width: 100px;" />
                                    </div>
                                </div>


                                {{-- Favicon --}}
                                <label for="favicon" class="form-label">Favicon</label>
                                <div class="mb-3">
                                    @if (!empty(get_setting('favicon')))
                                        <div class="favicon-preview" style="height: auto;">
                                            <img src="{{ asset('favicons/' . get_setting('favicon')) }}" alt="favicon"
                                                id="favicon-preview-img" width="32">
                                            <a href="javascript:void(0)" id="remove-favicon"
                                                style="float:right; color:grey;">X</a>
                                        </div>
                                    @endif

                                    <div class="after_remove_favicon"
                                        style="{{ !empty(get_setting('favicon')) ? 'display:none;' : '' }}">
                                        <input class="form-control" type="file" id="favicon" name="favicon"
                                            onchange="previewImage(this, '#favicon-preview-img')">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin-footer')
    <script>
        function previewImage(input, previewSelector) {
            console.log('privewImage');
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $(previewSelector).attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function() {
            $('#general_setting_form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: BASE_URL + "/admin/settings/update",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function() {
                        toastr.error("Something went wrong.");
                    }
                });
            });

            $('#remove-logo').on('click', function() {
                $.ajax({
                    url: BASE_URL + "/admin/settings/remove_logo",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            $("#logo").val("");
                            $("#logo-preview").attr('src', '#').hide();

                        } else {
                            toastr.error(response.message || "Could not remove logo");
                        }
                    },
                    error: function() {
                        toastr.error("Something went wrong.");
                    }
                });
            });

            $('#remove-favicon').on('click', function() {
                $.ajax({
                    url: BASE_URL + "/admin/settings/remove_favicon",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            $(".favicon-preview").remove();
                            $(".after_remove_favicon").html(
                                '<input class="form-control" type="file" id="favicon" name="favicon" onchange="previewImage(this, \'#favicon-preview-img\')">'
                            ).show();
                        } else {
                            toastr.error(response.message || "Could not remove favicon");
                        }
                    },
                    error: function() {
                        toastr.error("Something went wrong.");
                    }
                });
            });

        });
    </script>

@endsection
