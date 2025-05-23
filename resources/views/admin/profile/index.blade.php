@extends('admin.layouts.index')
@section('admin-title', 'Profile')

@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <h5 class="card-header">Profile</h5>
                    <div class="card-body">
                        <form id="profileForm">
                            @csrf

                            <div class="mb-3" id="logo-section">
                                <label for="logo" class="form-label">Profile Image</label>
                                <div class="position-relative mb-2" id="logo-preview"
                                 @if (empty($logo)) style="display: none;" @endif>
                                    @if (!empty($logo))
                                        <img src="{{ asset($logo) }}" alt="User Logo" width="100" class="border rounded">
                                        <button type="button" class="btn-close position-absolute top-0 start-100 translate-middle" aria-label="Remove"
                                            id="remove-logo-btn" style="background-color: red; opacity: 0.8;" data-logo="{{ $logo }}"></button>
                                    @endif
                                </div>

                                <input type="file" class="form-control mt-2" name="logo" id="logo" accept="image/*" @if (!empty($logo)) style="display: none;" @endif>
                            </div>
                            <div class="row mb-3">
                                <label for="img_privew" id="priview_image_title">Priview Image</label>
                                <div class="col-sm-10">
                                    <img id="img_privew" src="#" alt="" height="120px" width="auto" class="mt-2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ isset($name) ? $name : "" }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ isset($email) ? $email : "" }}">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="********">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>

                        <div id="loader-container" style="display: none;" class="text-center mt-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('admin-footer')
    <script src="{{ asset('assets/admin/theme/js/custom/profile.js') }}"></script>
@endsection
