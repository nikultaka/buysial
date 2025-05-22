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
                                <label for="logo" class="form-label">Logo</label>
                                @if (!empty($logo))
                                    <div class="position-relative d-inline-block mb-2" id="logo-preview">
                                        <img src="{{ asset($logo) }}" alt="User Logo" width="100" class="border rounded">
                                        <button type="button" class="btn-close position-absolute top-0 start-100 translate-middle" aria-label="Remove" id="remove-logo-btn" style="background-color: red; opacity: 0.8;" 
                                        data-logo="{{ isset($logo) ? $logo : "" }}"></button>
                                    </div>
                                @else
                                    <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                                @endif
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
