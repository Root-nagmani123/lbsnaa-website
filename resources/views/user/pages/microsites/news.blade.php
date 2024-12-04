@include('user.pages.microsites.includes.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>News</h1>
    <ul>
        @foreach ($newsItems as $news)
            <li>
                <p><img src="{{ asset($news->main_image) }}" style="width: 300px; height: 300px; object-fit: cover;"></p>
                <h3>{{ $news->title }}</h3>
                <p><em>Posted On:</em> {{ $news->created_at }}</p>
                <p>{{ $news->meta_title }}</p>                
                <a href="{{ route('news.details', $news->id) }}" class="btn btn-primary">Read More</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
@include('user.pages.microsites.includes.footer')