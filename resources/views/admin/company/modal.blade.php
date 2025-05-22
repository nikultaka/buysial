<div class="modal fade" id="companymodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">Add Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="companyForm" name="companyForm"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="hid" name="hid" value="">
                    <div id="oldimgbox" style="display: none;">
                        <label>Current Logo</label>
                        <div id="imgbox">
                        </div>
                    </div>
                    <div id="priview_image_title" style="display: none;">
                        <div style="display: flex; align-items: center; margin-bottom: 8px;">
                            <label for="img_privew" style="margin-right: 8px; margin-bottom: 0;">Preview Image</label>
                            <i class="fa fa-xmark fa-fw" id="close_icone"
                                style="color: red; cursor: pointer; font-size: 1.2rem;" title="Remove Image"></i>
                        </div>
                        <div>
                            <img id="img_privew" src="#" alt="Image Preview"
                                style="height: 120px; width: auto; margin-top: 10px; border-radius: 5px;" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="company_logo" class="form-label">Company Logo</label>
                        <input type="file" class="form-control" id="company_logo" name="company_logo"
                            accept="image/*">
                        <small class="text-muted">Allowed formats: JPG, JPEG, PNG, GIF, WEBP. Max size: 5MB</small>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_code" class="form-label">Company Code</label>
                        <input type="text" class="form-control" id="company_code" name="company_code" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_email" class="form-label">Company Email</label>
                        <input type="email" class="form-control" id="company_email" name="company_email" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_phone" class="form-label">Company Phone</label>
                        <input type="text" class="form-control" id="company_phone" name="company_phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_address" class="form-label">Company Address</label>
                        <input type="text" class="form-control" id="company_address" name="company_address" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_city" class="form-label">City</label>
                        <input type="text" class="form-control" id="company_city" name="company_city" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_state" class="form-label">State</label>
                        <input type="text" class="form-control" id="company_state" name="company_state" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_zip" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="company_zip" name="company_zip" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="company_country" name="company_country"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="company_website" class="form-label">Website</label>
                        <input type="url" class="form-control" id="company_website" name="company_website">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary w-25">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
