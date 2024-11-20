    $(document).ready(function () {
        $(document).on('change', '.status-toggle', function () {
            // console.log($('meta[name="csrf-token"]').attr('content'));return false;
            var checkbox = $(this);
            var recordId = checkbox.data('id');
            var table = checkbox.data('table');
            var column = checkbox.data('column');
            var newStatus = checkbox.prop('checked') ? 1 : 0;

            // Send AJAX request to toggle the status
            $.ajax({
                url: '/admin/toggle-status', // Single route
                // url: '/admin/menus/' + menuId + '/toggle-status',
                type: 'POST',
                
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: recordId,
                    table: table,
                    column: column,
                    status: newStatus
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert('Status update failed.');
                        // Revert the checkbox if the update fails
                        checkbox.prop('checked', !checkbox.prop('checked'));
                    }
                },
                error: function () {
                    alert('Error updating status.');
                    // Revert the checkbox if AJAX fails
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            });
        });
    });