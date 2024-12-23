@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">All Vacancy</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Vacancy</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">All Vacancies</h4>

            <a href="{{ route('micro_manage_vacancy.create') }}">
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
                            <th class="col">Uploaded Document / Website Link</th> <!-- Column for document or link -->
                            <th class="col">Option</th>
                            <th class="col">Actions</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vacancies as $vacancy)
                        <!-- Use $index for the incrementing index -->
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
                                @if($vacancy->content_type == 'PDF' && $vacancy->document_upload)

                                @if(in_array(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION), ['jpg', 'png',
                                'jpeg']))
                                <img src="{{ asset('storage/' . $vacancy->document_upload) }}" alt="Document Image"
                                    style="width: 100px; height: auto;">
                                @elseif(pathinfo($vacancy->document_upload, PATHINFO_EXTENSION) == 'pdf')

                                <a href="{{ asset('storage/' . $vacancy->document_upload) }}" target="_blank">View
                                    PDF</a>
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
                                <button type="button" class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-job_title="{{ $vacancy->job_title }}"
                                    data-content_type="{{ $vacancy->content_type }}"
                                    data-publish_date="{{ $vacancy->publish_date }}"
                                    data-expiry_date="{{ $vacancy->expiry_date }}"
                                    data-job_description="{{ $vacancy->job_description }}"
                                    data-image="{{ asset('/storage/' . $vacancy->document_upload) }}"
                                    data-website_link="{{ $vacancy->website_link }}"
                                    data-language="{{ $vacancy->language == 1 ? 'English' : 'Hindi' }}">
                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    <a href="{{ route('micro_manage_vacancy.edit', $vacancy->id) }}"
                                        class="btn bg-success text-white btn-sm w-auto d-flex align-items-center justify-content-center mb-2 mb-sm-0"
                                        style="height: 30px;">Edit</a>
                                    <form action="{{ route('micro_manage_vacancy.destroy', $vacancy->id) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-primary text-white w-auto d-flex align-items-center justify-content-center"
                                            style="height: 30px;"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>

                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                        data-table="micro_manage_vacancies" data-column="status"
                                        data-id="{{$vacancy->id}}" {{$vacancy->status ? 'checked' : ''}}>
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
// document.addEventListener('DOMContentLoaded', function() {
//     const viewButtons = document.querySelectorAll('.view-slider');
//     const modalTitle = document.getElementById('staticBackdropLabel');
//     const modalBody = document.querySelector('.modal-body');

//     viewButtons.forEach(button => {
//         button.addEventListener('click', function() {
//             // Extract data from the button
//             const job_title = this.dataset.job_title || 'N/A';
//             const content_type = this.dataset.content_type || 'N/A';
//             const publish_date = this.dataset.publish_date || 'N/A';
//             const expiry_date = this.dataset.expiry_date || 'N/A';
//             const image = this.dataset.image;
//             const website_link = this.dataset.website_link;
//             const job_description = this.dataset.job_description || 'N/A';
//             const language = this.dataset.language || 'N/A';

//             console.log('Image:', image);
//             console.log('Website Link:', website_link);

//             // Determine which to display: image or link
//             let fileContent = '';
//             if (image && image.trim() !== '' && image !== 'null') {
//                 fileContent =
//                     `<p><strong>File:</strong><img src="${image}" alt="Vacancy Image" class="img-fluid mb-3" style="width:100px; height:100px;" /></p>`;
//             } else if (website_link && website_link.trim() !== '' && website_link !== 'null') {
//                 fileContent =
//                     `<p><strong>Website Link:</strong> <a href="${website_link}" target="_blank">View Link</a></p>`;
//             } else {
//                 fileContent = `<p><strong>File:</strong> Not available</p>`;
//             }

//             // Update modal content
//             modalTitle.textContent = 'Tenders / Circulars Details';
//             modalBody.innerHTML = `
//                 <div>
//                     <p><strong>Job Title:</strong> ${job_title}</p>
//                     <p><strong>Content Type:</strong> ${content_type}</p>
//                     <p><strong>Publish Date:</strong> ${publish_date}</p>
//                     <p><strong>Expiry Date:</strong> ${expiry_date}</p>
//                     <p><strong>Description:</strong> ${job_description}</p>
//                     ${fileContent}
//                     <p><strong>Language:</strong> ${language}</p>
//                 </div>`;
//         });
//     });
// });




document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-slider');
    const modalTitle = document.getElementById('staticBackdropLabel');
    const modalBody = document.querySelector('.modal-body');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Extract data attributes with default fallback
            const job_title = this.dataset.job_title || 'N/A';
            const content_type = this.dataset.content_type || 'N/A';
            const publish_date = this.dataset.publish_date || 'N/A';
            const expiry_date = this.dataset.expiry_date || 'N/A';
            const image = this.dataset.image;
            const website_link = this.dataset.website_link;
            const job_description = this.dataset.job_description || 'N/A';
            const language = this.dataset.language || 'N/A';

            console.log('Image:', image);
            console.log('Website Link:', website_link);

            // Dynamically build file content
            let fileContent = '';
            if (image && image.trim() !== '' && image !== 'null') {
                fileContent = `
                    <p>
                        <strong>File:</strong>
                        <img src="${image}" alt="Vacancy Image" 
                             class="img-fluid mb-3" 
                             style="width:100px; height:100px;" 
                             onerror="this.onerror=null; this.src='placeholder.jpg';" />
                    </p>`;
            } else if (website_link && website_link.trim() !== '' && website_link !== 'null') {
                fileContent = `
                    <p>
                        <strong>Website Link:</strong>
                        <a href="${website_link}" target="_blank">View Link</a>
                    </p>`;
            } else {
                fileContent = `<p><strong>File:</strong> Not available</p>`;
            }

            // Update modal title and body
            modalTitle.textContent = 'Tenders / Circulars Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Job Title:</strong> ${job_title}</p>
                    <p><strong>Content Type:</strong> ${content_type}</p>
                    <p><strong>Publish Date:</strong> ${publish_date}</p>
                    <p><strong>Expiry Date:</strong> ${expiry_date}</p>
                    <p><strong>Description:</strong> ${job_description}</p>
                    ${fileContent}
                    <p><strong>Language:</strong> ${language}</p>
                </div>`;
        });
    });
});
</script>