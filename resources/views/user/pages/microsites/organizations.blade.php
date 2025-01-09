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
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
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
                        <div class="card-body" style="padding:0;">
                            <img src="{{ asset($organization->main_image) }}" class="img-fluid rounded" 
                            alt="organization Image" style="width: 100%; height: 50px; object-fit: cover; margin-bottom: 10px;">
                            <div class="card-footer" style="border:none;">
                                <div class="form-field mt-2">
                                    <p class="card-text" data-bs-toggle="modal" data-bs-target="#organizationModal{{ $organization->id }}">
                                        {{ $organization->employee_name }}
                                    </p>
                                    <p class="card-text">{{ $organization->designation }}</p>
                                    <p class="card-text">{{ $organization->email }}</p>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="organizationModal{{ $organization->id }}" tabindex="-1" aria-labelledby="organizationModalLabel{{ $organization->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset($organization->main_image) }}" class="img-fluid rounded" 
                                alt="organization Image" style="width: 100%; height: 50px; object-fit: cover; margin-bottom: 10px;">
                                <p><strong> {{ $organization->employee_name }}, {{ $organization->designation }} </strong></p>
                                <p><strong>Email:</strong> {{ $organization->email }}</p>
                                <p>{{ strip_tags($organization->program_description) }}</p>

                                <!-- Add more fields as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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