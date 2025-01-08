@extends('admin.layouts.master')

@section('title', 'Feedback List')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Feedback List</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Feedback List</span>
        </li>
    </ul>
</div>

<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Feedback List</h4>
        </div>
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->mobile }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ $categories[$feedback->category] ?? 'Unknown' }}</td>
                            <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format('d-m-Y H:i') }}</td>
                            <td class="text-truncate" style="max-width: 150px;" title="{{ $feedback->comments }}">
                                {{ Str::limit($feedback->comments, 50, '...') }}
                            </td>

                            <td>
                                <button class="btn btn-outline-primary btn-sm show-comment-btn" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop" data-comment="{{ $feedback->comments }}">
                                    View
                                </button>
                            </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Feedback Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalComment">No comment yet...</p> <!-- Placeholder for dynamic comment -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the modal comment placeholder
    const modalComment = document.getElementById('modalComment');

    // Get all buttons that trigger the modal
    const buttons = document.querySelectorAll('.show-comment-btn');

    // Attach event listeners to each button
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Retrieve the comment from the data attribute
            const comment = this.getAttribute('data-comment');

            // Set the retrieved comment into the modal
            modalComment.textContent = comment;
        });
    });
});
</script>


@endsection