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
    <textarea name="description" class="form-control ckeditor">{{ old('description', $manageTender->description ?? '') }}</textarea>
    @error('description')
        <div class="text-danger">{{ $message }}</div>
    @enderror
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

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>