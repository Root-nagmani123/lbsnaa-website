@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">User Management</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="text-decoration-none">
                <i class="ri-arrow-right-double-line"></i>
                <span>User Management</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Users</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">User List</h4>

            <a href="{{ route('users.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New User</span>
                    </span>
                </button>
            </a>
        </div>
        @if(Cache::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Cache::get('success_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(Cache::has('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Cache::get('error_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif 
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Name</th>
                            <th class="col">Email</th>
                            <th class="col">Status</th> <!-- Added Status Column -->
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->user_type == 2)
                                        @if($user->status == 1)
                                        <span
                                            class="badge bg-success bg-opacity-10 text-success py-2 px-3 fw-semibold">Active</span>
                                        @elseif(($user->status == 2) || ($user->status == 0))
                                        <span
                                            class="badge bg-danger bg-opacity-10 text-danger py-2 px-3 fw-semibold">Inactive</span>
                                        @endif
                                @elseif($user->user_type == 1)

                                <span
                                    class="badge bg-secondary bg-opacity-10 text-secondary py-2 px-3 fw-semibold">SuperAdmin</span>
                                @endif
                            </td>
                            <td>
                                @if($user->user_type == 2)
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-sm btn-warning text-white">Edit</a>
                                <form action="{{ route('users.delete', $user->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                   
                                        <button type="submit" class="btn btn-primary text-white btn-sm"
                                        onclick="return confirmDelete('{{ $user->status }}')">
                                            Delete
                                        </button>
                                </form>

                                <!-- Status Change Buttons -->
                                <form action="{{ route('users.updateStatus', $user->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @if($user->status == 1)
                                    <button type="submit" name="status" value="2"
                                        class="btn btn-sm btn-danger text-white">Set
                                        Inactive</button>
                                    @else
                                    <button type="submit" name="status" value="1"
                                        class="btn btn-sm btn-success text-white">Set Active</button>
                                    @endif
                                </form>
                                <a href="{{ route('users.permissions', $user->id) }}"
                                    class="btn btn-sm btn-primary text-white">Set
                                    Permissions</a>
                                @endif
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function confirmDelete(pageStatus) {
        if (pageStatus == 1) {
            alert('Active user cannot be deleted.');
            return false; // Prevent form submission
        } else {
            return confirm('Are you sure you want to delete?'); // Show confirmation if page_status is not 1
        }
    }
</script>