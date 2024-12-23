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
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Home Banner</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Slider List</h4>

            <a href="{{ route('admin.slider_create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Slider</span>
                    </span>
                </button>
            </a>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                            <th class="col">Image</th>
                            <th class="col">Name</th>
                            <th class="col">Banner Title</th>
                            <th class="col">Language</th>
                            <th class="col">Option</th>
                            <th class="col">Action</th>
                            <th class="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                            <td><img src="{{ asset('slider-images/' . $slider->image) }}" alt="slider image"
                                    class="img-fluid" width="100"></td>
                            <td>{{ $slider->text }}</td>

                            <td>{{ $slider->description }}</td>
                            <td>{{ $slider->language == 1 ? 'English': 'Hindi'}}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary fw-semibold btn-sm view-slider"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    data-text="{{ $slider->text }}"
                                    data-language="{{ $slider->language == 1 ? 'English': 'Hindi'}}"
                                    data-description="{{ $slider->description }}"
                                    data-image="{{ asset('slider-images/' . $slider->image) }}">
                                    View
                                </button>
                            </td>
                            <td>
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    <a href="{{ route('admin.slider_edit', $slider->id) }}"
                                        class="btn bg-success text-white btn-sm w-auto d-flex align-items-center justify-content-center mb-2 mb-sm-0"
                                        style="height: 30px;">Edit</a>
                                    <form action="{{ route('admin.slider_destroy', $slider->id) }}" method="POST"
                                        style="display:inline;">
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
                                        data-table="sliders" data-column="status" data-id="{{$slider->id}}"
                                        {{$slider->status ? 'checked' : ''}}>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Slider Details</h1>
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
            const text = this.dataset.text || 'N/A';
            const language = this.dataset.language || 'N/A';
            const description = this.dataset.description || 'N/A';
            const image = this.dataset.image || 'N/A';


            // Update modal content
            modalTitle.textContent = 'Slider Details';
            modalBody.innerHTML = `
                <div>
                    <p><strong>Text:</strong> ${text}</p>
                    <p><strong>Language:</strong> ${language}</p>
                    <p><strong>Description:</strong> ${description}</p>
                    <p><strong>Slider:</strong> <img src="${image}" alt="Main Image" style="max-width: 200px;"></p>
                </div>`;
        });
    });
});
</script>