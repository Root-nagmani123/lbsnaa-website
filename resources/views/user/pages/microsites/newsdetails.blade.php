@include('user.pages.microsites.includes.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }}</title>
</head>
<body>
    <h1>{{ $news->title }}</h1>

    <!-- Display all images -->
    <div>
        @if(!empty($news->multiple_images))
            @foreach ($news->multiple_images as $image)
                <p><img src="{{ asset($image) }}" style="width: 600px; height: 400px; object-fit: cover;"></p>
            @endforeach
        @else
            <p>No images available.</p>
        @endif
    </div>

    <p><strong>Meta Title:</strong> {{ $news->meta_title }}</p>
    <p><strong>Title Slug:</strong> {{ $news->title_slug }}</p>
    <p><strong>Description:</strong> {{ $news->description }}</p>
    <p><em>Posted On:</em> {{ $news->created_at }}</p>
</body>
</html>
@include('user.pages.microsites.includes.footer')
