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
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th> <!-- Index column -->
                            <th class="col">Tender Name</th>
                            <th class="col">File</th> <!-- Add a column for the file -->

                            <th class="col">Publish Date</th>
                            <th class="col">Expiry Date</th>
                            <th class="col">Language</th>
                            <th class="col">Option</th> <!-- Add a column for the file -->
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tenders as $tender)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $tender->title }}</td>
                            <td>
                                <!-- Display image if the file exists -->
                                @if($tender->file && in_array(pathinfo($tender->file, PATHINFO_EXTENSION), ['png',
                                'jpg', 'jpeg']))
                                <img src="{{ asset('/storage/tender/' . $tender->file) }}" alt="Uploaded File"
                                    width="100">
                                @elseif($tender->file)
                                <a href="{{ asset('/storage/tender/' . $tender->file) }}" target="_blank">View File</a>
                                @else
                                No file uploaded
                                @endif
                            </td>
                            <td>{{ $tender->publish_date }}</td>
                            <td>{{ $tender->expiry_date }}</td>
                            <td>{{ ($tender->language == 1) ? 'English' : 'Hindi' }}</td>
                            <td>
                                <button type="button"
                                    class="btn btn-outline-primary text-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-title="{{ $tender->title }}" data-type="{{ $tender->type }}"
                                    data-publish_date="{{ date('Y-m-d h:i A', strtotime($tender->publish_date)) }}"
                                    data-expiry_date="{{ date('Y-m-d h:i A', strtotime($tender->expiry_date)) }}"
                                    data-description="{{ $tender->description }}"
                                    data-image="{{ asset('/storage/tender/' . $tender->file) }}"
                                    data-language="{{ $tender->language == 1 ? 'English' : 'Hindi' }}">
                                    View
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('manage_tender.edit', $tender->id) }}"
                                    class="btn btn-success text-white fw-semibold btn-sm">Edit</a>
                                <form action="{{ route('manage_tender.destroy', $tender->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary text-white fw-semibold btn-sm"
                                        onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="manage_tenders" data-column="status" data-id="{{$tender->id}}"
                                        {{$tender->status ? 'checked' : ''}}>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- modal start -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tenders / Circulars Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="sliderText">Title</label>
                    <p id="sliderText"></p> <!-- Text will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">Type</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">publish_date</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderDescription">Type</label>
                    <p id="sliderDescription"></p> <!-- Description will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderImage">Image</label>
                    <img id="sliderImage" src="" width="100" /> <!-- Image will be injected here -->
                </div>
                <div class="form-group">
                    <label for="sliderLanguage">Language</label>
                    <p id="sliderLanguage"></p> <!-- Language will be injected here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-slider');
    const modalTitle = document.getElementById('staticBackdropLabel');
    const modalBody = document.querySelector('.modal-body');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Extract data from the button
            const title = this.dataset.title;
            const type = this.dataset.type;
            const publish_date = this.dataset.publish_date;
            const expiry_date = this.dataset.expiry_date;
            const image = this.dataset.image;
            const description = this.dataset.description;
            const language = this.dataset.language;

            // Update modal content
            modalTitle.textContent = 'Tenders / Circulars Details';
            modalBody.innerHTML = `<div>
                    <p><strong>Title:</strong> ${title}</p>
                    <p><strong>Type:</strong> ${type} </p>
                    <p><strong>Publish Date:</strong> ${publish_date}</p>
                    <p><strong>Expiry Date:</strong> ${expiry_date}</p>
                    <p><strong>Description:</strong> ${description}</p>
                    <p><strong>Language:</strong> ${language}</p>
                    
                   <p><strong>File:</strong>
    <!-- Embed PDF (viewable in modal) -->
    <object data="${image}" type="application/pdf" width="100%" height="200"></object>
    <br>
    <!-- Provide a download link for the PDF -->
    <a href="${image}" download="TenderFile.pdf">Download PDF</a>
</p>
                    </div>`;
        });
    });
});
</script>