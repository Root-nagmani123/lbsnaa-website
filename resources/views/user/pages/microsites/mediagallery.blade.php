@include('user.pages.microsites.includes.header')

<div style="text-align: center; margin: 30px 0;">
    <h2 style="color: #3a3a3a;">Media Gallery</h2>
    <p style="color: #666;">Browse and explore the different media galleries</p>

    <!-- Gallery Icons Section -->
    <div class="gallery-section" style="display: flex; justify-content: center; gap: 40px; margin-top: 40px;">
        <!-- Photos Gallery -->
        <div class="gallery-item" style="text-align: center; width: 150px;">
            <a href="{{ route('user.media_gallery') }}" style="text-decoration: none; color: inherit;">
                <img src="{{ asset('path_to_images/photo_icon.png') }}" alt="Photos Gallery" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 10px;">
                <div style="font-size: 18px; color: #007bff;">Photos Gallery</div>
            </a>
        </div>

        <!-- Videos Gallery -->
        <div class="gallery-item" style="text-align: center; width: 150px;">
            <a href="{{ route('videoGallery') }}" style="text-decoration: none; color: inherit;">
                <img src="{{ asset('path_to_images/video_icon.png') }}" alt="Videos Gallery" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 10px;">
                <div style="font-size: 18px; color: #007bff;">Video Gallery</div>
            </a>
        </div>
    </div>
</div>

@include('user.pages.microsites.includes.footer')


<style>
    .gallery-section {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 40px;
    }

    .gallery-item {
        text-align: center;
        width: 150px;
    }

    .gallery-item img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-bottom: 10px;
    }

    .gallery-item div {
        font-size: 18px;
        color: #007bff;
    }

</style>