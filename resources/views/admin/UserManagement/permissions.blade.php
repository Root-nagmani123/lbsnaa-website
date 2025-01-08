@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">User Management</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Permissions</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Set Permissions for {{ $user->name }}</h4>
            <a href="{{ route('users.index') }}">
                <button class="border-0 btn btn-secondary py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <span>Back</span>
                    </span>
                </button>
            </a>
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
        <form action="{{ route('users.permissions.update') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">Module</th>
                    <th class="col">Sub-module</th>
                    <th class="col">Permission</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                <tr>
                    <td>{{ $module->parent }}</td>
                    <td>{{ $module->child }}</td>
                    <td>
                        <div class="form-check form-switch">
                        <input class="form-check-input status-toggle_permission" type="checkbox" role="switch"
                                            data-table="modules" data-column="status" data-id="{{$module->id}}"   data-module-id="{{ $module->id }}" 
                                            @php
            $isManageUserAllowed = in_array($module->id, array_column($permissions->where('is_allowed', 1)->toArray(), 'module_id'));
            @endphp
            @if ($isManageUserAllowed)
            checked
            @endif
                                          >
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>

        </div>
    </div>
</div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Event delegation: Listen for changes on the entire document
    document.addEventListener('change', function (event) {
        // Check if the event target has the 'status-toggle_permission' class
        if (event.target.classList.contains('status-toggle_permission')) {
            // alert(); // Debugging: To confirm the event is triggered

            // Get module ID and user permission status
            const moduleId = event.target.getAttribute('data-module-id');
            const isAllowed = event.target.checked ? 1 : 0;
          
            // Perform AJAX request to update the permission
            fetch('/admin/users/permissions/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    module_id: moduleId,
                    user_id: {{ $user->id }},
                    is_allowed: isAllowed
                })
            })
            .then(response => response.json())
            .then(data => {

                if (data.success) {
                    console.log('Permission updated successfully.');
                } else {
                    console.error('Failed to update permission:', data.message);
                }
                window.location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    });

});


    </script>