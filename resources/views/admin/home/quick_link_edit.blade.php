@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Quick Link</h2>

    <form action="{{ route('admin.quick_links.update', $quickLink->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="text">Text</label>
            <input type="text" name="text" class="form-control" value="{{ $quickLink->text }}" required>
        </div>

        <div class="form-group">
        <label for="link_type">Link Type</label>
        <select id="link_type" class="form-control" name="link_type" onchange="toggleLinkInput()">
            <option value="url" {{ $quickLink->url ? 'selected' : '' }}>URL</option>
            <option value="file" {{ $quickLink->file ? 'selected' : '' }}>Document</option>
        </select>
    </div>

    <!-- URL input field -->
    <div id="url_input" class="form-group" style="display: none;">
        <label for="url">URL</label>
        <input type="text" name="url" value="{{ $quickLink->url }}" class="form-control">
        <small class="text-muted">Provide a URL if you're not uploading a document.</small>
    </div>

    <!-- File upload field -->
    <div id="file_input" class="form-group" style="display: none;">
        <label for="file">Document (PDF)</label>
        <input type="file" name="file" class="form-control">
        <small class="text-muted">Upload a new document to replace the current one (PDF only).</small>

        @if ($quickLink->file)
            <p>Current File: <a href="{{ asset('quick-links-files/' . $quickLink->file) }}" target="_blank">View Document</a></p>
        @endif
    </div>


        <div class="form-group">
            <label for="status">Status</label>
            <input type="checkbox" name="status" value="1" {{ $quickLink->status ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

<script>
    function toggleLinkInput() {
    var linkType = document.getElementById('link_type').value;

    // Hide both by default
    document.getElementById('url_input').style.display = 'none';
    document.getElementById('file_input').style.display = 'none';

    // Show the relevant input based on the selection
    if (linkType === 'url') {
        document.getElementById('url_input').style.display = 'block';
    } else if (linkType === 'file') {
        document.getElementById('file_input').style.display = 'block';
    }
}

// Call the function on page load in case there's a default selection
window.onload = function() {
    toggleLinkInput();
}

    </script>