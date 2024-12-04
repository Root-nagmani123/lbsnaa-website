@include('user.pages.microsites.includes.header')

<div style="margin: 20px 0;">
    <form action="{{ route('photoGalleries.filterGallery') }}" method="GET" style="display: flex; gap: 10px; align-items: center;">
        <!-- Keyword Search -->
        <label for="keyword">Search:</label>
        <input type="text" name="keyword" id="keyword" placeholder="Keyword Search" value="{{ request('keyword') }}" style="padding: 5px;">

        <!-- Category Dropdown -->
        <select name="category" style="padding: 5px;">
            <option value="">All Categories</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}" {{ request('category') == $course->id ? 'selected' : '' }}>
                    {{ $course->course_name }}
                </option>
            @endforeach
        </select>

        <!-- Year Dropdown -->
        <select name="year" style="padding: 5px;">
            <option value="">All Years</option>
            @for($year = date('Y'); $year >= 2000; $year--)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endfor
        </select>

        <!-- Submit Button -->
        <button type="submit" style="padding: 5px 10px;">Submit</button>

        <!-- Clear Button -->
        <button type="button" onclick="clearFilters()" style="padding: 5px 10px; background-color: #f4f4f4; border: 1px solid #ccc;">Clear</button>
    </form>
</div>

<!-- Gallery Display -->
@if(isset($photoGalleries) && $photoGalleries->isNotEmpty())
    <div class="gallery-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
        @foreach ($photoGalleries as $gallery)
            <div class="gallery-card" style="width: 300px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <div style="padding: 15px;">
                    <h3 style="margin: 0 0 10px; font-size: 18px; color: #333;">{{ $gallery->image_title_english }}</h3>
                    <p style="margin: 0; font-size: 14px; color: #666;">{{ $gallery->image_title_hindi }}</p>
                </div>

                @php
                    $imageFiles = json_decode($gallery->image_files, true);
                @endphp

                @if(is_array($imageFiles) && !empty($imageFiles))
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; padding: 10px;">
                        @foreach ($imageFiles as $imageFile)
                            <div style="width: 100px; height: 100px; overflow: hidden; border: 1px solid #ddd; border-radius: 5px;">
                                <img src="{{ asset('storage/' . $imageFile) }}" alt="{{ $gallery->image_title_english }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="padding: 10px; color: #999;">No valid images available.</p>
                @endif
            </div>
        @endforeach
    </div>
@else
    <p style="text-align: center; color: #999; font-size: 18px;">No photos available.</p>
@endif

@include('user.pages.microsites.includes.footer')

<script>
    function clearFilters() {
        document.getElementById('keyword').value = '';
        document.querySelector('select[name="category"]').selectedIndex = 0;
        document.querySelector('select[name="year"]').selectedIndex = 0;
        document.querySelector('form').submit();
    }
</script>
