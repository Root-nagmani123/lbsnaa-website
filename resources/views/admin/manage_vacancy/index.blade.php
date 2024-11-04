@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>All Vacancies</h2>
    <a href="{{ route('manage_vacancy.create') }}" class="btn btn-primary">Add Vacancy</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th> <!-- Add index column -->
                <th>Job Title</th>
                <th>Language</th>
                <th>Publish Date</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Uploaded Document / Website Link</th> <!-- Column for document or link -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacancies as $vacancy)
                <tr>
                    <!-- Display index -->
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>{{ $vacancy->job_title }}</td>
                    <td>{{ $vacancy->language }}</td>
                    <td>{{ $vacancy->publish_date }}</td>
                    <td>{{ $vacancy->expiry_date }}</td>
                    <td>
                        @if ($vacancy->status == 1)
                            Draft
                        @elseif ($vacancy->status == 2)
                            Approval
                        @elseif ($vacancy->status == 3)
                            Publish
                        @else
                            Unknown
                        @endif
                    </td>
                    <td>
                        @if($vacancy->content_type == 'PDF' && $vacancy->document_upload)
                            <!-- Check if document is an image -->
                            @if(in_array(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg']))
                                <img src="{{ asset('storage/' . $vacancy->document_upload) }}" alt="Document Image" style="width: 100px; height: auto;">
                            @elseif(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION) == 'pdf')
                                <!-- Provide a link to download or view the PDF -->
                                <a href="{{ asset('storage/' . $vacancy->document_upload) }}" target="_blank">View PDF</a>
                            @else
                                No document uploaded.
                            @endif
                        @elseif($vacancy->content_type == 'Website' && $vacancy->website_link)
                            <!-- Display website link if content type is Website -->
                            <a href="{{ $vacancy->website_link }}" target="_blank">View Link</a>
                        @else
                            No document or link available.
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('manage_vacancy.edit', $vacancy->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('manage_vacancy.destroy', $vacancy->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
