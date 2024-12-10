<div class="row">
    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Page Language:</label>
            <span class="star">*</span>

            <div class="form-group position-relative">
                <input type="radio" name="language" value="1"
                    {{ old('language', $manageTender->language ?? '') == 1 ? 'checked' : '' }}> English
                <input type="radio" name="language" value="2"
                    {{ old('language', $manageTender->language ?? '') == 2 ? 'checked' : '' }}> Hindi
            </div>

            @error('language')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Type:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <select name="type" class="form-control">
                    <option value="">Select</option>
                    <option value="Tender" {{ old('type', $manageTender->type ?? '') == 'Tender' ? 'selected' : '' }}>
                        Tender
                    </option>
                    <option value="Circular"
                        {{ old('type', $manageTender->type ?? '') == 'Circular' ? 'selected' : '' }}>
                        Circular
                    </option>
                </select>
            </div>
            @error('type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-4">
            <label class="label">Title:</label>
            <div class="form-group positive-relative">
                <input type="text" name="title" class="form-control"
                    value="{{ old('title', $manageTender->title ?? '') }}">
            </div>
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group mb-4">
            <label class="label">Description:</label>
            <div class="form-group position-relative">
                <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"
                    rows="5">{{ old('description', $manageTender->description ?? '') ?? '' }}</textarea>
            </div>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Upload File (PDF, PNG, JPG):</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="file" name="file" class="form-control">
            </div>

            @if(isset($manageTender->file))
            <div class="mt-2">
                @if(in_array(pathinfo($manageTender->file, PATHINFO_EXTENSION), ['jpg', 'png', 'jpeg']))
                <label>Current File (Image):</label><br>
                <img src="{{ asset('storage/uploads/' . $manageTender->file) }}" alt="Uploaded Image"
                    style="width: 150px; height: auto;">
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
    </div> -->

    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Upload File (PDF Only):</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="file" name="file" class="form-control" accept=".pdf">
            </div>

            @if(isset($manageTender->file))
            <div class="mt-2">
                @if(pathinfo($manageTender->file, PATHINFO_EXTENSION) == 'pdf')
                <label>Current File (PDF):</label><br>
                <a href="{{ asset('storage/uploads/' . $manageTender->file) }}" target="_blank">View PDF</a>
                @endif
            </div>
            @endif

            @error('file')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>


    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Publish Date:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="date" name="publish_date" class="form-control"
                    value="{{ old('publish_date', $manageTender->publish_date ?? '') }}">
            </div>
            @error('publish_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Expiry Date:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="date" name="expiry_date" class="form-control"
                    value="{{ old('expiry_date', $manageTender->expiry_date ?? '') }}">
            </div>
            @error('expiry_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Status:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <select name="status" class="form-control">
                    <option value="">Select</option>
                    <option value="1" {{ old('status', $manageTender->status ?? '') == '1' ? 'selected' : '' }}>Active
                    </option>
                    <option value="0" {{ old('status', $manageTender->status ?? '') == '0' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>
            @error('status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>