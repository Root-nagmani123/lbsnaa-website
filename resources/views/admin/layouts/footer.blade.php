<div class="flex-grow-1"></div>

<footer class="footer-area bg-white text-center rounded-top-10">
    <p class="fs-14">© <?php echo date("Y");?> -  <span style="color: #af2910;">LBSNAA Administration</span> is Proudly Owned by <a
            href="https://www.digitalindia.gov.in/" target="_blank" class="text-decoration-none" style="color: #af2910;">National eGovernance Division (NeGD)</a>. Copyright Ministry of Electronics & IT, Government of India. All rights reserved.</p>
</footer>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('admin_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('admin_assets/js/dragdrop.js') }}"></script>
<script src="{{ asset('admin_assets/js/rangeslider.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/sweetalert.js') }}"></script>
<script src="{{ asset('admin_assets/js/quill.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
<script src="{{ asset('admin_assets/js/prism.js') }}"></script>
<script src="{{ asset('admin_assets/js/clipboard.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/feather.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/amcharts.js') }}"></script>
<script src="{{ asset('admin_assets/js/custom/custom.js') }}"></script>
<script src="{{ asset('admin_assets/js/ckeditor.js') }}"></script>
<script src="{{ asset('admin_assets/js/custom/toggle.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function () {
        $("#sortable_faculty").sortable({
            handle: ".handle",
            update: function (event, ui) {
                let sortedIDs = $("#sortable_faculty").sortable("toArray", { attribute: "data-id" });

                $.ajax({
                    url: "{{ route('admin.faculty.updateOrder') }}",
                    type: "POST",
                    data: {
                        order: sortedIDs,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        alert("Position Updated Successfully!");
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $("#sortable-staff").sortable({
            handle: ".handle", // Specify the handle for dragging
            update: function(event, ui) {
              
                let sortedIDs = $("#sortable-staff").sortable("toArray", { attribute: "data-id" });

                // Send updated order to the server
                $.ajax({
                    url: "{{ route('admin.staff.updateOrder') }}",
                    type: "POST",
                    data: {
                        order: sortedIDs,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            alert("Staff order updated successfully!");
                        }
                    }
                });
            }
        });
    });

</script>
