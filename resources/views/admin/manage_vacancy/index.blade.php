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
                    <th class="col">#</th> <!-- Add index column -->
                    <th class="col">Job Title</th>
                    <th class="col">Publish Date</th>
                    <th class="col">Expiry Date</th>
                    <th class="col">Language</th>
                    <th class="col">Uploaded Document / Website Link</th> <!-- Column for document or link -->
                    <th class="col">Actions</th>
                    <th class="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vacancies as $vacancy) <!-- Use $index for the incrementing index -->
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                    
                            <td>{{ $vacancy->job_title }}</td>
                            <td>{{ $vacancy->publish_date }}</td>
                            <td>{{ $vacancy->expiry_date }}</td>
                            <td>{{ $vacancy->language == 1 ? 'English' : 'Hindi' }}</td>
                             <td>   @if($vacancy->content_type == 'PDF' && $vacancy->document_upload)
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
                                <a href="{{ route('manage_vacancy.edit', $vacancy->id) }}" class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('manage_vacancy.destroy', $vacancy->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white">Delete</button>
                                </form>
                            </td>
                            <td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch"  data-table="manage_vacancies" 
            data-column="status" data-id="{{$vacancy->id}}" {{$vacancy->status ? 'checked' : ''}}>
          </div></td>
                        </tr>
                        @endforeach
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
@endsection
