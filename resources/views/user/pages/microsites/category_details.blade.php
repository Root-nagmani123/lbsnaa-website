@include('user.pages.microsites.includes.header')




@if($category->isNotEmpty())
    <div class="row" id="skip_to_main_content">
        @foreach($category as $gallery)
            @php
                // Decode the JSON array or split the string
                $images = json_decode($gallery->image_files, true) ?? explode(',', $gallery->image_files);
            @endphp
            @if($images)
                @foreach($images as $image)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . trim($image, '"')) }}" alt="{{ $gallery->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $gallery->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
@else
    <p>No galleries found.</p>
@endif






@include('user.pages.microsites.includes.footer')