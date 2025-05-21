@extends('admin.layouts.index')
@section('admin-title', 'Dashboard')
@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <h5 class="card-header">Dashboard</h5>
                    <div class="card-body">
                        <p class="mb-0">Welcome to the admin dashboard!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('admin-footer')
    <script src="{{ asset('assets/admin/theme/js/custom/team.js') }}"></script>
@endsection
