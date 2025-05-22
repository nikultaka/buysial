<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form onsubmit="return false" method="POST" id="userForm" name="userForm"
        enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body row">
                    {{-- Name --}}
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    {{-- Phone --}}
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    {{-- Address --}}
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"></textarea>
                    </div>

                    {{-- Country --}}
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Country</label>
                        <select name="country" id="country" class="form-select" required>
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ isset($country->name) ? $country->name : '' }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- State --}}
                    <div class="mb-3 col-md-4">
                        <label class="form-label">State</label>
                        <select name="state" id="state" class="form-select" required>
                            <option value="">Select State</option>
                            {{-- Dynamic states --}}
                        </select>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">City</label>
                        <select name="city" id="city" class="form-select" required>
                            <option value="">Select City</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">ZIP Code</label>
                        <input type="text" name="zip" class="form-control">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="">Select Role</option>
                            <option value="SUPER-ADMIN">SUPER ADMIN</option>
                            <option value="ADMIN">ADMIN</option>

                        </select>
                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Company</label>
                        <select name="company" class="form-select" required>
                            <option value="">Select Company</option>
                            <option value="1">Palladium Hub</option>
                            <option value="2">Platly Soft</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-user-btn">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
