@include('user.pages.microsites.includes.header')

@if(isset($organizations))
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.micrositebyslug', ['slug' => $slug]) }}"
                                style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Organization Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
    <!-- Gallery Display -->
    @if($organizations->isNotEmpty())
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                @foreach ($organizations as $organization)
                <div class="col-lg-3 mb-4">
                    <div class="card card-lift h-100">
                        <div class="card-header text-center" style="border:0;">
                            <img src="{{ $organization->main_image ? url($organization->main_image) : '' }}"
                                class="avatar avatar-xxl rounded-circle" alt="organization Image">
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="form-field mt-2">
                                <h3 class="h3">{{ $organization->employee_name ?? '' }}</h3>
                                <p class="text-secondary">{{ $organization->designation ?? '' }}</p>
                            </div>
                            <div class="text-start">
                                <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#organizationModal{{ $organization->id }}"
                                    style="color: #af2910;">View
                                    Profile
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="organizationModal{{ $organization->id }}" tabindex="-1"
                    aria-labelledby="organizationModalLabel{{ $organization->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ $organization->main_image ? url($organization->main_image) : '' }}"
                                            class="img-fluid rounded-4 mb-4" alt="organization Image"
                                            style="object-fit: cover;height:150px;width:200px;">
                                    </div>
                                    <div class="col-lg-9">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th class="col">Name :-</th>
                                                    <td>{{ $organization->employee_name ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col">Designation :-</th>
                                                    <td>{{ $organization->designation ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="col">Email :-</th>
                                                    <td>{{ $organization->email ?? '' }}</td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-lg-12">
                                        <p>{!! html_entity_decode($organization->program_description ?? '') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p style="text-align: center; color: #999; font-size: 18px;">No organization available.</p>
            @endif
        </div>

        <!-- Quick Links -->
        <div class="col-12 col-lg-3 mb-4">
            <div class="card card-hover border">
                <div class="card-header" style="background-color: #af2910;">
                    <h3 class="text-white">Quick Links</h3>
                </div>
                <div class="card-body" style="padding: 0;">
                    <ul class="mt-2 mb-2 list-group list-group-flush">
                        @forelse($quickLinks as $link)
                        <li class="text-start list-group-item">
                            @if($link->website_url)
                            <!-- For website URL -->
                            <a href="{{ $link->website_url }}" class="text-primary" target="_blank">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z">
                                        </path>
                                    </svg>
                                </span>
                                {{ $link->txtename }}
                            </a>
                            @elseif($link->pdf_file)
                            <!-- For PDF URL -->
                            <a href="{{ asset('storage/' . $link->pdf_file) }}" class="text-primary" target="_blank">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                        <path
                                            d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z" />
                                    </svg>
                                </span>
                                {{ $link->txtename }}
                            </a>
                            @endif
                        </li>
                        @empty
                        <!-- If no quickLinks are available -->
                        <li class="text-start list-group-item text-danger">No data available</li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
    </div>
</section>
@endif

@include('user.pages.microsites.includes.footer')