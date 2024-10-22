@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h2>Menu List</h2>
        <a class="btn btn-primary" href="{{ route('admin.menus.create') }}" >new add menu</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Menu Title</th>
                    <th>Parent Menu</th>
                    <th>Menu Type</th>
                    <th>Content Position</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($menuTree as $menu)
                {!! renderMenu($menu) !!}
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Attach change event to all toggle switches
        $('.status-toggle').change(function() {
            var checkbox = $(this);
            var menuId = checkbox.data('id');

            // Send AJAX request to toggle the status
            $.ajax({
                url: '/admin/menus/' + menuId + '/toggle-status',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status) {
                        alert('Menu status updated to Active.');
                    } else {
                        alert('Menu status updated to Inactive.');
                    }
                },
                error: function() {
                    alert('Error updating status.');
                    // Revert the checkbox if AJAX fails
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            });
        });
    });
</script>

<style>
    /* CSS for switch */
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:checked + .slider:before {
      transform: translateX(26px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>




@endsection
