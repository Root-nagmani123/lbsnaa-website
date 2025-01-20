@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage News</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('Managenews.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">News</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">News and Updates</h4>

            <a href="{{ route('Managenews.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add News</span>
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
                            <th class="col">#</th>
                            <th class="col">Title</th>
                            <th class="col">Research Center</th>
                            <th class="col">Start Date</th>
                            <th class="col">Language</th>
                            <th class="col">Option</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->rese_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>

                            <td>{{ $item->language == 1 ? 'English' : 'Hindi' }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-title="{{ $item->title }}" data-meta_title="{{ $item->meta_title }}"
                                    data-meta_keywords="{{ $item->meta_keywords }}"
                                    data-meta_description="{{ $item->meta_description }}"
                                    data-short_description="{{ $item->short_description }}"
                                    data-start_date="{{ $item->start_date }}" data-end_date="{{ $item->end_date }}"
                                    data-main_image="{{ asset( $item->main_image) }}"
                                    data-multiple_images="{{ asset( $item->multiple_images) }}"
                                    data-language="{{ $item->language == 1 ? 'English' : 'Hindi' }}">
                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex justify-content-start align-items-start gap-2">
                                    <a href="{{ route('Managenews.edit', $item->id) }}"
                                        class="btn btn-success text-white btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('Managenews.destroy', $item->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary text-white btn-sm"
                                            onclick="return confirm('Are you sure you want to delete?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="managenews" data-column="status" data-id="{{$item->id}}"
                                        {{$item->status ? 'checked' : ''}}>
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



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Vacancies Details</h1>
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

    // Get the dynamic base URL
    const baseURL = `${window.location.protocol}//${window.location.host}/`;

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Extract data from the button
            const title = this.dataset.title || 'N/A';
            const meta_title = this.dataset.meta_title || 'N/A';
            const meta_keywords = this.dataset.meta_keywords || 'N/A';
            const meta_description = this.dataset.meta_description || 'N/A';
            const short_description = this.dataset.short_description || 'N/A';
            const start_date = this.dataset.start_date || 'N/A';
            const end_date = this.dataset.end_date || 'N/A';
            const main_image = this.dataset.main_image;
            const multiple_images = this.dataset.multiple_images || '';
            const language = this.dataset.language || 'N/A';

            // Clean up and split the multiple_images string
            let imagesHTML = '';
            if (multiple_images) {
                // Remove any square brackets, extra quotes, and escape characters
                const cleanedImages = multiple_images.replace(/[\[\]"\\]/g, '').split(',');

                // Iterate through the cleaned image paths and prepend the base URL
                cleanedImages.forEach(image => {
                    const trimmedImage = image.trim(); // Trim any extra spaces

                    // Prepend base URL to the image path if it doesn't already contain it
                    const imageUrl = trimmedImage.startsWith('http') ? trimmedImage :
                        baseURL + trimmedImage;

                    // Create the HTML for the image
                    imagesHTML +=
                        `<img src="${imageUrl}" alt="Image" style="max-width: 100px; margin: 5px; display: inline-block;">`;
                });
            }

            // Update modal content
            modalTitle.textContent = 'News Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Title:</strong> ${title}</p>
                    <p><strong>Meta Title:</strong> ${meta_title}</p>
                    <p><strong>Meta Keywords:</strong> ${meta_keywords}</p>
                    <p><strong>Meta Description:</strong> ${meta_description}</p>
                    <p><strong>Short Description:</strong> ${short_description}</p>
                    <p><strong>Start Date:</strong> ${start_date}</p>
                    <p><strong>End Date:</strong> ${end_date}</p>
                    <p><strong>Language:</strong> ${language}</p>
                    <p><strong>Main Image:</strong> <img src="${main_image}" alt="Main Image" style="max-width: 200px;"></p>
                    <p><strong>Multiple Images:</strong></p>
                    <div>${imagesHTML}</div>
                </div>`;
        });
    });
});
</script>