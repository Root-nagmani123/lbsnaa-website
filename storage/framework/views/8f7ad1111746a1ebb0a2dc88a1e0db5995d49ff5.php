

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col">
        <h2>Edit Menu</h2>
        <form action="<?php echo e(route('admin.menus.update', $menu->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> <!-- Use PUT method for updating -->

            <!-- Menu Title Field -->
            <div class="frm_row">
                <span class="label1">
                    <label for="menutitle">Menu Title :</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <input type="text" name="menutitle" id="menutitle" class="form-control" value="<?php echo e($menu->menutitle); ?>" required>
                </span>
                <div class="clear"></div>
            </div>

            <!-- Menu Type Dropdown -->
            <div class="frm_row">
                <span class="label1">
                    <label for="texttype">Menu Type :</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <select name="texttype" id="texttype" class="form-control" autocomplete="off"
                        onchange="addmenutype(this.value)" required>
                        <option value="">Select</option>
                        <option value="1" <?php echo e($menu->texttype == 1 ? 'selected' : ''); ?>>Content</option>
                        <option value="2" <?php echo e($menu->texttype == 2 ? 'selected' : ''); ?>>PDF file Upload</option>
                        <option value="3" <?php echo e($menu->texttype == 3 ? 'selected' : ''); ?>>Web Site Url</option>
                    </select>
                </span>
                <div class="clear"></div>
            </div>

            <!-- Additional Fields Container -->
            <div id="additional-fields" style="display: none;">
                <!-- Content Field -->
                <div class="frm_row" id="content-field" style="display: none;">
                    <span class="label1">
                        <label for="content">Content:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <textarea name="content" id="content" class="form-control"><?php echo e($menu->content); ?></textarea>
                    </span>
                    <div class="clear"></div>
                    <div class="frm_row">
                    <span class="label1">
                        <label for="meta_title">Meta Title:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <input type="text" name="meta_title" id="meta_title" class="form-control" value="<?php echo e($menu->meta_title); ?>" >
                    </span>
                    <div class="clear"></div>
                </div>

                <!-- Meta Keyword Field -->
                <div class="frm_row">
                    <span class="label1">
                        <label for="meta_keyword">Meta Keyword:</label>
                    </span>
                    <span class="input1">
                        <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="<?php echo e($menu->meta_keyword); ?>">
                    </span>
                    <div class="clear"></div>
                </div>

                <!-- Meta Description Field -->
                <div class="frm_row">
                    <span class="label1">
                        <label for="meta_description">Meta Description:</label>
                    </span>
                    <span class="input1">
                        <textarea name="meta_description" id="meta_description" class="form-control"><?php echo e($menu->meta_description); ?></textarea>
                    </span>
                    <div class="clear"></div>
                </div>
                </div>

                <!-- PDF File Upload Field -->
                <div class="frm_row" id="pdf-upload-field" style="display: none;">
                    <span class="label1">
                        <label for="pdf_file">Upload PDF:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept=".pdf">
                        <p>Current File: <a href="<?php echo e(asset($menu->pdf_file)); ?>" target="_blank"><?php echo e($menu->pdf_file); ?></a></p>
                    </span>
                    <div class="clear"></div>
                </div>

                <!-- Website URL Field -->
                <div class="frm_row" id="website-url-field" style="display: none;">
                    <span class="label1">
                        <label for="website_url">Website URL:</label>
                        <span class="star">*</span>
                    </span>
                    <span class="input1">
                        <input type="text" name="website_url" id="website_url" class="form-control" value="<?php echo e($menu->website_url); ?>">
                    </span>
                    <div class="clear"></div>
                </div>

                <!-- Meta Title Field -->
                
            </div>

            <!-- Primary Link Field -->
            <div class="frm_row">
                <span class="label1">
                    <label for="menucategory">Primary Link:</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <select name="menucategory" id="menucategory" class="form-control">
                        <option value="0" <?php echo e($menu->menucategory == 0 ? 'selected' : ''); ?>>It is Root Category</option>
                        <?php echo $menuOptions; ?>

                    </select>
                </span>
            </div>

            <!-- Content Position Field -->
            <div class="frm_row">
                <span class="label1">
                    <label for="txtpostion">Content Position:</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <select name="txtpostion" id="txtpostion" class="form-control" required>
                        <option value="">Select</option>
                        <option value="1" <?php echo e($menu->txtpostion == 1 ? 'selected' : ''); ?>>Header Menu</option>
                        <option value="2" <?php echo e($menu->txtpostion == 2 ? 'selected' : ''); ?>>Bottom Menu</option>
                        <option value="4" <?php echo e($menu->txtpostion == 4 ? 'selected' : ''); ?>>Director Message Menu</option>
                        <option value="5" <?php echo e($menu->txtpostion == 5 ? 'selected' : ''); ?>>Life Academy Menu</option>
                        <option value="6" <?php echo e($menu->txtpostion == 6 ? 'selected' : ''); ?>>Other Pages</option>
                        <option value="7" <?php echo e($menu->txtpostion == 7 ? 'selected' : ''); ?>>Latest Updates</option>
                    </select>
                </span>
            </div>
            <div id="additional-fields-for-letest-update" style="display: none;">
            <div class="frm_row">
                        <span class="label1">
                            <label for="start_date">Start Date:</label>
                        </span>
                        <span class="input1">
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo e($menu->start_date); ?>">
                        </span>
                        <div class="clear"></div>
                    </div>

                    <!-- Termination Date Field -->
                    <div class="frm_row">
                        <span class="label1">
                            <label for="termination_date">Termination Date:</label>
                        </span>
                        <span class="input1">
                            <input type="date" name="termination_date" id="termination_date" class="form-control" value="<?php echo e($menu->termination_date); ?>">
                        </span>
                        <div class="clear"></div>
                    </div>
                    </div>
            <div class="frm_row"> 
                <span class="label1">
                    <label for="txtpostion">Status:</label>
                    <span class="star">*</span>
                </span>
                <span class="input1">
                    <select name="menu_status" id="menu_status" class="form-control" required>
                        <option value="">Select</option>
                        <option value="1" <?php echo e($menu->menu_status == 1 ? 'selected' : ''); ?>>Active</option>
                        <option value="2" <?php echo e($menu->menu_status == 2 ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </span>
            </div>

            <!-- Submit Button -->
            <div class="frm_row">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

        <script>
        function addmenutype(value) {
            // Show or hide additional fields based on the selected menu type
            document.getElementById('additional-fields').style.display = 'block';
            document.getElementById('content-field').style.display = 'none';
            document.getElementById('pdf-upload-field').style.display = 'none';
            document.getElementById('website-url-field').style.display = 'none';

            if (value === '1') { // Content
                document.getElementById('content-field').style.display = 'block';
            } else if (value === '2') { // PDF file upload
                document.getElementById('pdf-upload-field').style.display = 'block';
            } else if (value === '3') { // Website URL
                document.getElementById('website-url-field').style.display = 'block';
            }
        }

        // Call addmenutype function to show the correct fields when the page loads
        addmenutype('<?php echo e($menu->texttype); ?>');

        function handlePositionChange(value) {
            // Hide additional fields if not related to "Latest Updates"
            const additionalFields = document.getElementById('additional-fields-for-letest-update');
            if (value === '7') { // Latest Updates
                additionalFields.style.display = 'block';
                // You can add more logic here if needed
            } else {
                additionalFields.style.display = 'none';
            }
        }

        // Initialize the fields based on the current menu type and position
        window.onload = function() {
          
            document.getElementById('txtpostion').value = "<?php echo e($menu->txtpostion); ?>"; // Set the current position
            handlePositionChange("<?php echo e($menu->txtpostion); ?>"); // Initialize the position fields
        }

        </script>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/menus/edit.blade.php ENDPATH**/ ?>