@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Media Center</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Photo Gallery</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Photo Gallery</h4>
            <a href="{{ route('photo-gallery.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Photo Gallery</span>
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
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Category Name</th>
                            <th class="col">Media Category</th>
                            <th class="col">Image Title (English)</th>
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $index => $gallery)
                        <!-- Use $index to track the row number -->
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td>{{ $gallery->name ?? 'N/A' }}</td>
                            <td>{{ $gallery->media_cat_name ?? 'N/A' }}</td>
                            <td>{{ $gallery->image_title_english }}</td>
                            <td>
                                <button type="button"
                                    class="btn btn-outline-primary text-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-name="{{ $gallery->name }}"
                                    data-media_cat_name="{{ $gallery->media_cat_name }}"
                                    data-image_title_english="{{ $gallery->image_title_english }}"
                                    data-image_title_hindi="{{ $gallery->image_title_hindi }}"
                                    data-related_news="{{ $gallery->related_news }}"
                                    data-related_events="{{ $gallery->related_events }}"
                                    data-image_files="{{ $gallery->image_files }}">
                                    View
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('photo-gallery.edit', $gallery->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('photo-gallery.destroy', $gallery->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white"
                                        onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="manage_photo_galleries" data-column="status"
                                        data-id="{{$gallery->id}}" {{$gallery->status ? 'checked' : ''}}>
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
            const name = this.dataset.name;
            const media_cat_name = this.dataset.media_cat_name;
            const publish_date = this.dataset.publish_date;
            const image_title_english = this.dataset.image_title_english;
            const image_title_hindi = this.dataset.image_title_hindi;
            const related_news = this.dataset.related_news;
            const related_events = this.dataset.related_events;
            const image_files = this.dataset.image_files;

            // Parse the JSON string to get the array of image paths
            let images = [];
            try {
                images = JSON.parse(image_files); // Decode JSON-encoded string
            } catch (error) {
                console.error("Error parsing image files:", error);
            }
            const baseUrl = `${window.location.protocol}//${window.location.hostname}:${window.location.port}`;

            // Generate HTML for the images
            let imagesHtml = '<div>';
            images.forEach(image => {
                imagesHtml +=
                    `<img src="${baseUrl}/storage/${image}" alt="Image" style="max-width: 100px; margin-right: 10px;">`;

            });
            imagesHtml += '</div>';

            // Update modal content
            modalTitle.textContent = 'Photo Gallery Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Category Name:</strong> ${name}</p>
                    <p><strong>Related Training Program:</strong> ${media_cat_name}</p>                    
                    <p><strong>Image Title (English):</strong> ${image_title_english}</p>
                    <p><strong>Image TItle (Hindi):</strong> ${image_title_hindi}</p>
                    <p><strong>Images:</strong></p>
                    ${imagesHtml}
                </div>`;
        });
    });
});
</script>