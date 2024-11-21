@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Whats New / Quick Link</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('Managenews.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Manage Whats New / Quick Link</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Manage Whats New / Quick Link</h4>

            <a href="{{ route('microquicklinks.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Name</th>
                            <th class="col">Title</th>
                            <th class="col">Language</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quick_links as $links)
                        <tr>
                           <td>{{ $loop->iteration}}</td>
                           <td>{{ $links->txtename }}</td>
                            <td>{{ $links->meta_description }}</td>
                            <td>{{ $links->language == 1 ? 'English' : 'Hindi' }}</td>
                            {{-- <!-- <td>{{ $links->status ? 'Active' : 'Inactive' }}</td> --> --}}
                            <td>
                                @if ($links->status == 1)
                                <span
                                    class="badge bg-success bg-opacity-10 text-success py-2 fw-semibold text-center">Active</span>
                                @elseif ($links->status == 0)
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('microquicklinks.edit', $links->id) }}"
                                    class="btn btn-success text-white fw-semibold btn-sm">Edit</a>
                                <form action="{{ route('microquicklinks.destroy', $links->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-primary text-white fw-semibold btn-sm" onclick="return confirm('Are you sure you want to delete this link ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
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
                url: '/admin/micromenu/' + menuId + '/toggle-status',
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


@endsection