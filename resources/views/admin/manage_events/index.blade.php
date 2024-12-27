@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">All Events</h4>

            <a href="{{ route('manage_events.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Event</span>
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
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th> <!-- New column for index -->
                            <th class="col">Language</th>
                            <th class="col">Title</th>
                            <th class="col">Course</th>
                            <th class="col">Start Date</th>
                            <th class="col">End Date</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $index => $event) <!-- Use $index to track the iteration -->
                        <tr>
                            <td>{{ $index + 1 }}</td> <!-- Display the index + 1 for human-readable numbering -->
                            <td>{{ $event->language }}</td>
                            <td>{{ $event->event_title }}</td>
                            <td>{{ $event->course->name ?? 'N/A' }}</td>
                            <td>{{ $event->start_date }}</td>
                            <td>{{ $event->end_date }}</td>
                            <td>
                                @if ($event->status == 1)
                                    Draft
                                @elseif ($event->status == 2)
                                    Approval
                                @elseif ($event->status == 3)
                                    Publish
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('manage_events.edit', $event->id) }}"
                                    class="btn btn-success text-white">Edit</a>
                                <form action="{{ route('manage_events.destroy', $event->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary text-white" onclick="return confirm('Are you sure you want to delete this faculty member?')">Delete</button>
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

@endsection
