@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Tender</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Tender / Circulars</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">All Tenders / Circulars</h4>

            <a href="{{ route('manage_tender.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Tender/Circular</span>
                    </span>
                </button>
            </a>
        </div>
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th> <!-- Index column -->
                            <th class="col">Language</th>
                            <th class="col">Title</th>
                            <th class="col">Type</th>
                            
                            <th class="col">Publish Date</th>
                            <th class="col">Expiry Date</th>
                            <th class="col">Status</th>
                            <th class="col">File</th> <!-- Add a column for the file -->
                            <th class="col">Actions</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenders as $tender)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ ($tender->language == 1) ? 'English' : 'Hindi' }}</td>
                            <td>{{ $tender->title }}</td>
                            <td>{{ $tender->type }}</td>
                           
                            <td>{{ $tender->publish_date }}</td>
                            <td>{{ $tender->expiry_date }}</td>
                            <td>
                                @if ($tender->status == 1)
                                    <span class="badge bg-warning bg-opacity-10 text-warning py-2 fw-semibold text-center">Draft</span>
                                @elseif ($tender->status == 2)
                                    <span class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Approved</span>
                                @elseif ($tender->status == 3)
                                    <span class="badge bg-success bg-opacity-10 text-success py-2 fw-semibold text-center">Publish</span>
                                @endif
                            </td>
                            <td>
                                <!-- Display image if the file exists -->
                                @if($tender->file && in_array(pathinfo($tender->file, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg']))
                                    <img src="{{ asset('/storage/uploads/' . $tender->file) }}" alt="Uploaded File" width="100">
                                @elseif($tender->file)
                                    <a href="{{ asset('/storage/uploads/' . $tender->file) }}" target="_blank">View File</a>
                                @else
                                    No file uploaded
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('manage_tender.edit', $tender->id) }}"
                                    class="btn btn-success text-white fw-semibold btn-sm">Edit</a>
                                <form action="{{ route('manage_tender.destroy', $tender->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary text-white fw-semibold btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
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
