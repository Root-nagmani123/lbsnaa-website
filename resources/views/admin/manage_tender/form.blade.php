<div class="form-group">
    <label>Page Language:</label>
    <div>
        <label><input type="radio" name="language" value="English" {{ old('language', $manageTender->language ?? '') == 'English' ? 'checked' : '' }}> English</label>
        <label><input type="radio" name="language" value="Hindi" {{ old('language', $manageTender->language ?? '') == 'Hindi' ? 'checked' : '' }}> Hindi</label>
    </div>
    @error('language')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group"> 
    <label>Type:</label>
    <select name="type" class="form-control">
        <option value="">Select</option>
        <option value="Tender" {{ old('type', $manageTender->type ?? '') == 'Tender' ? 'selected' : '' }}>Tender</option>
        <option value="Circular" {{ old('type', $manageTender->type ?? '') == 'Circular' ? 'selected' : '' }}>Circular</option>
    </select>
    @error('type')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Title:</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $manageTender->title ?? '') }}">
    @error('title')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Description:</label>
    
    <!-- Hidden input to store the editor content for submission -->
    <input type="hidden" name="description" id="description">

    <!-- Quill editor container with toolbar -->
    <div id="standalone-container">
        <div id="toolbar-container">
            <span class="ql-formats">
                <select class="ql-font"></select>
                <select class="ql-size"></select>
            </span>
            <span class="ql-formats">
                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>
                <button class="ql-strike"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-blockquote"></button>
                <button class="ql-code-block"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>
                <button class="ql-indent" value="-1"></button>
                <button class="ql-indent" value="+1"></button>
            </span>
            <span class="ql-formats">
                <button class="ql-link"></button>
                <button class="ql-image"></button>
                <button class="ql-video"></button>
            </span>
        </div>
        <div id="editor-container" style="height: 250px;">
            {!! old('description', $manageTender->description ?? '') !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label>Upload File (PDF, PNG, JPG):</label>
    <input type="file" name="file" class="form-control">
    
    @if(isset($manageTender->file))
        <div class="mt-2">
            @if(in_array(pathinfo($manageTender->file, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg']))
                <label>Current File (Image):</label><br>
                <img src="{{ asset('storage/uploads/' . $manageTender->file) }}" alt="Uploaded Image" style="width: 150px; height: auto;">
            @elseif(pathinfo($manageTender->file, PATHINFO_EXTENSION) == 'pdf')
                <label>Current File (PDF):</label><br>
                <a href="{{ asset('storage/uploads/' . $manageTender->file) }}" target="_blank">View PDF</a>
            @endif
        </div>
    @endif

    @error('file')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Publish Date:</label>
    <input type="date" name="publish_date" class="form-control" value="{{ old('publish_date', $manageTender->publish_date ?? '') }}">
    @error('publish_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Expiry Date:</label>
    <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $manageTender->expiry_date ?? '') }}">
    @error('expiry_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Status:</label>
    <select name="status" class="form-control">
        <option value="">Select</option>
        <option value="1" {{ old('status', $manageTender->status ?? '') == '1' ? 'selected' : '' }}>Draft</option>
        <option value="2" {{ old('status', $manageTender->status ?? '') == '2' ? 'selected' : '' }}>Approval</option>
        <option value="3" {{ old('status', $manageTender->status ?? '') == '3' ? 'selected' : '' }}>Publish</option>
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script> -->