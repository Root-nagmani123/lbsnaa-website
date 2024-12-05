

<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Menu</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="<?php echo e(route('admin.index')); ?>" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Add Menu</span>
        </li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-20 mb-20">
                    <h4 class="fw-semibold fs-18 mb-0">Add Menu</h4>
                </div>

                <form action="<?php echo e(route('admin.menus.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Page Language :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="radio" name="txtlanguage" value="1"> English
                                    <input type="radio" name="txtlanguage" value="2"> Hindi
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="menutitle">Menu Title :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <input type="text" class="form-control text-dark ps-5 h-58" name="menutitle"
                                        id="menutitle">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group mb-4">
                                <label class="label" for="texttype">Menu Type :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select name="texttype" id="texttype" class="form-control text-dark ps-5 h-58"
                                        required>
                                        <option value="">Select</option>
                                        <option value="1">Content</option>
                                        <option value="2">PDF file Upload</option>
                                        <option value="3">Website URL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="content-field" style="display: none;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label" for="content">Content :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control ps-5 text-dark" rows="5" name="content"
                                                id="content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="meta_title">Meta Title:</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <input type="text" class="form-control text-dark ps-5 h-58"
                                                    name="meta_title" id="meta_title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <label class="label" for="meta_keyword">Meta Keyword :</label>
                                            <span class="star">*</span>
                                            <div class="form-group position-relative">
                                                <input type="text" class="form-control text-dark ps-5 h-58"
                                                    name="meta_keyword" id="meta_keyword">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label" for="meta_description">Meta Description :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <textarea class="form-control ps-5 text-dark"
                                                placeholder="Some demo text ... " cols="30" rows="5"
                                                name="meta_description" id="meta_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="display: none;" id="pdf-upload-field">
                            <div class="form-group mb-4">
                                <label class="label" for="pdf_file">Upload PDF</label>
                                <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                    <div class="product-upload">
                                        <label for="file-upload" class="file-upload mb-0">
                                            <i class="ri-upload-cloud-2-line fs-2 text-gray-light"></i>
                                            <span class="d-block fw-semibold text-body">Drop files here or click
                                                to upload.</span>
                                        </label>
                                        <input id="file-upload" type="file" name="pdf_file" id="pdf_file" accept=".pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="website-url-field" style="display: none;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="website_url">Website URL:</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58"
                                                name="website_url" id="website_url">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="web_site_target">Web Site Target :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <select class="form-select form-control ps-5 h-58" name="web_site_target"
                                                id="web_site_target" autocomplete="off">
                                                <option selected value="0" class="text-dark">Select</option>
                                                <option value="1" class="text-dark">Internal Link</option>
                                                <option value="2" class="text-dark">External Link</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menucategory">Primary Link :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" name="menucategory"
                                        id="menucategory" autocomplete="off">
                                        <option selected value="0" class="text-dark">It is Root Category</option>
                                        <?php echo $menuOptions; ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="txtpostion">Content Position :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" id="txtpostion"
                                        autocomplete="off" autocomplete="off" name="txtpostion" required
                                        onchange="showDateFields(this.value)">
                                        <option selected class="text-dark">Select</option>
                                        <option value="1" class="text-dark">Header Menu</option>
                                        <option value="2" class="text-dark">Bottom Menu</option>
                                        <option value="3" class="text-dark">Footer Menu</option>
                                        <option value="4" class="text-dark">Director Message Menu</option>
                                        <option value="5" class="text-dark">Life Academy Menu</option>
                                        <option value="6" class="text-dark">Other Pages</option>
                                        <option value="7" class="text-dark">Latest Updates</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="date-fields" style="display: none;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="start_date">Start Date:</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="date" class="form-control text-dark ps-5 h-58"
                                                name="start_date" id="start_date" onfocus="(this.type='date')"
                                                onblur="(this.type='text')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label class="label" for="termination_date">Termination Date :</label>
                                        <span class="star">*</span>
                                        <div class="form-group position-relative">
                                            <input type="text" class="form-control text-dark ps-5 h-58"
                                                name="termination_date" id="termination_date" placeholder="dd/mm/yyyy"
                                                onfocus="(this.type='date')" onblur="(this.type='text')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label" for="menu_status">Status :</label>
                                <span class="star">*</span>
                                <div class="form-group position-relative">
                                    <select class="form-select form-control ps-5 h-58" id="menu_status"
                                        name="menu_status" required>
                                        <option class="text-dark">Select</option>
                                        <option value="1" class="text-dark">Active</option>
                                        <option value="2" class="text-dark">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex ms-sm-3 ms-md-0">
                            <button class="btn btn-success text-white fw-semibold" type="submit">Submit</button>&nbsp;
                            <a href="<?php echo e(route('admin.menus.index')); ?>" class="btn btn-secondary text-white">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('texttype').addEventListener('change', function() {
    const value = this.value;
    document.getElementById('content-field').style.display = value === '1' ? 'block' : 'none';
    document.getElementById('pdf-upload-field').style.display = value === '2' ? 'block' : 'none';
    document.getElementById('website-url-field').style.display = value === '3' ? 'block' : 'none';
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/admin/menus/create.blade.php ENDPATH**/ ?>