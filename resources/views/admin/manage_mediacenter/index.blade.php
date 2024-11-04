@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h2>Audio Gallery</h2>
<a href="{{ route('media-center.create') }}" class="btn btn-primary">Add New Audio</a>

<table class="table">
    <thead>
        <tr>
            <th>Category</th>
            <th>Audio Title (English)</th>
            <th>Audio Title (Hindi)</th>
            <th>Audio File</th>
            <th>Page Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($audios as $audio)
        <tr>
            <td>{{ $audio->category_name }}</td>
            <td>{{ $audio->audio_title_en }}</td>
            <td>{{ $audio->audio_title_hi }}</td>
            <td><a href="{{ asset('uploads/audios/'.$audio->audio_upload) }}" target="_blank">Play</a></td>
            <td>
                @if ($audio->page_status == 1)
                    Draft
                @elseif ($audio->page_status == 2)
                    Approval
                @elseif ($audio->page_status == 3)
                    Publish
                @else
                    Unknown
                @endif
            </td>
            <td>
                <a href="{{ route('media-center.edit', $audio->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('media-center.destroy', $audio->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                    
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
