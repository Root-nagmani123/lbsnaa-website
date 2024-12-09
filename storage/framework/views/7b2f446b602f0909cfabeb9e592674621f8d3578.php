

<?php $__env->startSection('content'); ?>
<h1>Add New Course</h1>

<form action="<?php echo e(route('admin.courses.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label>Course Name *</label>
        <input type="text" name="course_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Abbreviation *</label>
        <input type="text" name="abbreviation" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Meta Title *</label>
        <input type="text" name="meta_title" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Meta Keyword</label>
        <input type="text" name="meta_keyword" class="form-control">
    </div>

    <div class="form-group">
        <label>Meta Description</label>
        <textarea id="meta_description" name="meta_description" rows="4" class="form-control"></textarea>

    </div>

    <div class="form-group">
        <label>Description *</label>
        <textarea id="editor1" name="description" rows="4" class="form-control Description"></textarea>
    </div>

    <div class="form-group">
        <label>Course Start Date *</label>
        <input type="date" name="course_start_date" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Course End Date *</label>
        <input type="date" name="course_end_date" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Support Section *</label>
        <select name="support_section" class="form-control" required>
            <option value="" disabled selected>Select Section</option>
            <option value="1"  >first</option>
            <option value="2"  >second</option>
            <option value="3"  >third</option>
            <!-- Add options dynamically if available -->
        </select>
    </div>

    <div class="form-group">
        <label>Co-ordinator</label>
        <input type="text" name="coordinator_id" class="form-control" placeholder="Type and search">
    </div>

    <!-- Repeat similar structure for each Assistant Coordinator -->
    <div class="form-group">
    <label>1st Asst. Co-ordinator</label>
    <input type="text" name="asst_coordinator_1_id" class="form-control" placeholder="Type and search">
</div>

<div class="form-group">
    <label>2nd Asst. Co-ordinator</label>
    <input type="text" name="asst_coordinator_2_id" class="form-control" placeholder="Type and search">
</div>

<div class="form-group">
    <label>3rd Asst. Co-ordinator</label>
    <input type="text" name="asst_coordinator_3_id" class="form-control" placeholder="Type and search">
</div>

<div class="form-group">
    <label>4th Asst. Co-ordinator</label>
    <input type="text" name="asst_coordinator_4_id" class="form-control" placeholder="Type and search">
</div>

<div class="form-group">
    <label>5th Asst. Co-ordinator</label>
    <input type="text" name="asst_coordinator_5_id" class="form-control" placeholder="Type and search">
</div>


    <div class="form-group">
        <label>Important Links</label>
        <textarea name="important_links" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Course Type</label>
        <select name="course_type" class="form-control">
            <option value="" disabled selected>Select Type</option>
            <option value="1"  >first</option>
            <option value="2"  >second</option>
            <option value="3"  >third</option>
        </select>
    </div>

    <div class="form-group">
        <label>Venue *</label>
        <select name="venue_id" class="form-control" required>
            <option value="" disabled selected>Select Venue</option>
            <option value="1"  >first</option>
            <option value="2"  >second</option>
            <option value="3"  >third</option>
        </select>
    </div>

    <div class="form-group">
        <label>Registration On *</label>
        <div>
            <input type="radio" name="registration_on" value="1" required> On
            <input type="radio" name="registration_on" value="0" required> Off
        </div>
    </div>

    <div class="form-group">
        <label>Page Status *</label>
        <select name="page_status" class="form-control" required>
            <option value="" disabled selected>Select Status</option>
            <option value="1"  >active</option>
            <option value="2"  >inactive</option>
            <!-- Add options dynamically if available -->
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('meta_description');
    var productDescription = CKEDITOR.instances['editor1'].getData();
    var productDescription = CKEDITOR.instances['meta_description'].getData();
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp4\htdocs\lbsnaa_website\resources\views/admin/courses/create.blade.php ENDPATH**/ ?>