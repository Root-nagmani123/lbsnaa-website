@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">All Vacancies</h4>
            
            <a href="{{ route('manage_vacancy.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Vacancy</span>
                    </span>
                </button>
            </a>
        </div>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="default-table-area members-list">
    <div class="table-responsive">
        <table class="table align-middle" id="myTable">
            <thead>
                <tr class="text-center">
                    <th class="col">ID</th> <!-- Add index column -->
                    <th class="col">Job Title</th>
                    <th class="col">Research Centre</th>
                    <th class="col">Language</th>
                    <th class="col">Publish Date</th>
                    <th class="col">Expiry Date</th>
                    <th class="col">Status</th>
                    <th class="col">Uploaded Document / Website Link</th> <!-- Column for document or link -->
                    <th class="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vacancies as $vacancy) <!-- Use $index for the incrementing index -->
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $vacancy->job_title }}</td>
                            <td>{{ $vacancy->research_centre_name }}</td>
                            <td>
                                @if ($vacancy->language == 1)
                                    English
                                @elseif ($vacancy->language == 2)
                                    Hindi
                                @endif
                            </td>
                            <td>{{ $vacancy->publish_date }}</td>
                            <td>{{ $vacancy->expiry_date }}</td>
                            <td>
                                @if ($vacancy->status == 1)
                                    Draft
                                @elseif ($vacancy->status == 2)
                                    Approval
                                @elseif ($vacancy->status == 3)
                                    Publish
                                @endif
                            </td>
                            <td>
                                @if($vacancy->content_type == 'PDF' && $vacancy->document_upload)
                                   
                                    @if(in_array(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg']))
                                        <img src="{{ asset('storage/' . $vacancy->document_upload) }}" alt="Document Image" style="width: 100px; height: auto;">
                                    @elseif(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION) == 'pdf')
                                        
                                        <a href="{{ asset('storage/' . $vacancy->document_upload) }}" target="_blank">View PDF</a>
                                    @else
                                        No document uploaded.
                                    @endif
                                @elseif($vacancy->content_type == 'Website' && $vacancy->website_link)
                                    
                                    <a href="{{ $vacancy->website_link }}" target="_blank">View Link</a>
                                @else
                                    No document or link available.
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('manage_vacancy.edit', $vacancy->id) }}" class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('manage_vacancy.destroy', $vacancy->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button>
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
