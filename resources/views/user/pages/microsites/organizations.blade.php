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
                        <a href="{{ route('user.micrositebyslug', ['slug' => $slug]) }}" style="color: #af2910;">Home</a>
                    </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Organization </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> Organization Details</li>
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
            @foreach ($organizations as $organization)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-header text-center" style="border:0;">
                        <img src="{{ asset($organization->main_image) }}" class="avatar avatar-xl rounded-circle" 
                        alt="organization Image" style="object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <div class="card-footer" style="border:none;">
                                <div class="form-field mt-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#organizationModal{{ $organization->id }}">
                                        {{ $organization->employee_name }}
                                    </a>
                                    <p class="card-text">{{ $organization->designation }}</p>
                                    <p class="card-text">{{ $organization->email }}</p>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="organizationModal{{ $organization->id }}" tabindex="-1" aria-labelledby="organizationModalLabel{{ $organization->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <img src="{{ asset($organization->main_image) }}" class="img-fluid rounded-4 mb-4" 
                                        alt="organization Image" style="object-fit: cover;height:100px;">
                                    </div>
                                    <div class="col-lg-3">
                                        <p>Name:-</p>
                                        <p>Designation:-</p>
                                        <p>Email:-</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p><strong>
                                        {{ $organization->employee_name }}
                                        </strong></p>
                                        <p>{{ $organization->designation }}</p>
                                        <p>{{ $organization->email }}</p>
                                    </div>
                                    <div class="col-lg-12">
                                    <p>{{ strip_tags($organization->program_description) }}</p>
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
</section>

@endif

@include('user.pages.microsites.includes.footer')