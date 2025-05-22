@extends('admin.layouts.index')
@section('admin-title', 'Company Management')
@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Company Management</h4>
        <div class="card p-2">
            <div class="row gy-3">
                <div class="col-lg-6 col-md-6">
                    <!-- <h5 class="card-header">Team</h5> -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <button type="button" class="btn btn-primary float-end mt-2 ms-2 mb-4" id="addcompany">
                        Add
                    </button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table pt-2 " id="companyTable">
                    <thead class="table-light  mt-3">
                        <tr class="text-nowrap">
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Company Code</th>
                            <th>Company Email</th>
                            <th>Company Phone</th>
                            <th>Company Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.company.modal')
@endsection
@section('admin-footer')
    <script src="{{ asset('assets/admin/theme/js/custom/company.js') }}"></script>
@endsection
