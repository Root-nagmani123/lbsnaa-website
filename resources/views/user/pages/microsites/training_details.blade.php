@include('user.pages.microsites.includes.header')

@if(isset($trainingdetails))
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
                            <a href="#" style="color: #af2910;">Training Details </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Training Program Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
    <!-- Quick Links -->
    <div class="col-12 col-lg-3 mb-4">
        <div class="card card-hover border">
            <div class="card-header" style="background-color: #af2910;">
                <h3 class="text-white">Quick Links</h3>
            </div>
            <div class="card-body" style="padding: 0;">
                <ul class="mt-2 mb-2 list-group list-group-flush">
                    @foreach($quickLinks as $link)
                        <li class="text-start list-group-item">
                            @if($link->website_url)
                                <!-- For website URL -->
                                <a href="{{ $link->website_url }}" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                                        </svg>
                                    </span>
                                    {{ $link->txtename }}
                                </a>
                            @elseif($link->pdf_file)
                                <!-- For PDF URL -->
                                <a href="{{ asset('storage/' . $link->pdf_file) }}" class="text-primary" target="_blank">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                            <path d="M9 1H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7l-5-6zm0 1.5V6h5L9 2.5zM4 2h5v4H4V2zM3 12V4h5v4h5v4H3z"/>
                                        </svg>
                                    </span>
                                    {{ $link->txtename }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

        <p><strong>Course Information</strong></p>
    @if($trainingdetails)
        <p><strong>Program Name:</strong> {{ $trainingdetails->program_name }}</p>
        <p><strong>Venue:</strong> {{ $trainingdetails->venue }}</p>
        <p><strong>Course Coordinator:</strong> {{ $trainingdetails->program_coordinator }}</p>
        <p><strong>Duration:</strong> {{ $trainingdetails->start_date }} To {{ $trainingdetails->end_date }}</p>
        <p><strong>Program Description:</strong> {!! html_entity_decode($trainingdetails->program_description ?? '') !!}</p>

    @else
        <p>No training details available.</p>
    @endif



@include('user.pages.microsites.includes.footer')
@endif