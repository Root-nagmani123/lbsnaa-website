@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Menu</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Menu</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="row align-items-center justify-content-between border-bottom pb-3 mb-3">
            <div class="col-12 col-sm-auto text-center text-sm-start mb-3 mb-sm-0">
                <h4 class="fw-semibold fs-18 mb-0">Menu List</h4>
            </div>
            <div class="col-12 col-sm-auto text-center text-sm-end">
                <a href="{{ route('admin.menus.create') }}">
                    <button class="btn btn-success py-2 px-3 text-white fs-14 fw-semibold rounded-3">
                        <i class="ri-add-line text-white me-2"></i>
                        <span>Add New Menu</span>
                    </button>
                </a>
            </div>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle text-center" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu Title</th>
                            <th scope="col">Parent Menu</th>
                            <th scope="col">Content Position</th>
                            <th scope="col">Action</th>
                            <th scope="col">Status</th>
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
                // url: '/admin/menus/' + menuId + '/toggle-status',
                url: '{{ url("admin/menus") }}/' + menuId + '/toggle-status',
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
