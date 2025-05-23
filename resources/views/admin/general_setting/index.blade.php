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
                                        <div style="height: auto;">
                                            <img src="{{ asset('logos/' . get_setting('logo')) }}" alt="logo"
                                                width="100">
                                            <a href="javascript:void(0)" id="remove-logo"
                                                style="float:right; color:grey;">X</a>
                                        </div>
                                    @else
                                        <input class="form-control" type="file" id="logo" name="logo">
                                    @endif
                                </div>

                                {{-- Favicon --}}
                                <label for="favicon" class="form-label">Favicon</label>
                                <div class="mb-3">
                                    @if (!empty(get_setting('favicon')))
                                        <div style="height: auto;">
                                            <img src="{{ asset('favicons/' . get_setting('favicon')) }}" alt="favicon"
                                                width="32">
                                            <a href="javascript:void(0)" id="remove-favicon"
                                                style="float:right; color:grey;">X</a>
                                        </div>
                                    @else
                                        <input class="form-control" type="file" id="favicon" name="favicon">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
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
                if (!confirm('Remove logo?')) return;

                $.ajax({
                    url: BASE_URL + "/admin/settings/remove_logo",
                    type: "GET",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 800);
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
                if (!confirm('Remove favicon?')) return;

                $.ajax({
                    url: BASE_URL + "/admin/settings/remove_favicon",
                    type: "GET",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 800);
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
