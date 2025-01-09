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
            <span class="star">*</span>
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
            <span class="star">*</span>
            <div class="form-group position-relative">
                <textarea class="form-control" id="description" placeholder="Enter the Description" name="description"
                    rows="5">{{ old('description', $manageTender->description ?? '') ?? '' }}</textarea>
            </div>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

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
                <a href="{{ asset('storage/tender/' . $manageTender->file) }}" target="_blank">View PDF</a>
                @endif
            </div>
            @endif

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Corrigendum (PDF Only):</label>
           
            <div class="form-group position-relative">
                <input type="file" name="corrigendum" class="form-control" accept=".pdf">
            </div>

            @if(isset($manageTender->corrigendum))
            <div class="mt-2">
                @if(pathinfo($manageTender->corrigendum, PATHINFO_EXTENSION) == 'pdf')
                <label>Current File (PDF):</label><br>
                <a href="{{ asset('storage/tender/' . $manageTender->corrigendum) }}" target="_blank">View PDF</a>
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
            <label class="label">Publish Date & Time:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="datetime-local" id="publish_date" name="publish_date" class="form-control"
                    value="{{ old('publish_date', isset($manageTender->publish_date) ? date('Y-m-d\TH:i', strtotime($manageTender->publish_date)) : '') }}"
                    min="{{ now()->format('Y-m-d\TH:i') }}">
            </div>
            @error('publish_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group mb-4">
            <label class="label">Expiry Date & Time:</label>
            <span class="star">*</span>
            <div class="form-group position-relative">
                <input type="datetime-local" id="expiry_date" name="expiry_date" class="form-control"
                    value="{{ old('expiry_date', isset($manageTender->expiry_date) ? date('Y-m-d\TH:i', strtotime($manageTender->expiry_date)) : '') }}"
                    min="{{ now()->format('Y-m-d\TH:i') }}">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const publishDateInput = document.getElementById('publish_date');
    const expiryDateInput = document.getElementById('expiry_date');
    const now = new Date().toISOString().slice(0, 16); // Get current datetime in YYYY-MM-DDTHH:mm format

    // Set the minimum date to prevent selecting past dates
    publishDateInput.setAttribute('min', now);
    expiryDateInput.setAttribute('min', now);

    // Ensure expiry date is always after or equal to publish date
    publishDateInput.addEventListener('change', function() {
        const publishDate = publishDateInput.value;
        if (publishDate) {
            // Set expiry_date min to publish_date value
            expiryDateInput.setAttribute('min', publishDate);
        } else {
            // Reset to current date if publish date is cleared
            expiryDateInput.setAttribute('min', now);
        }
    });

    // Ensure users cannot set old dates manually in publish_date field
    publishDateInput.addEventListener('blur', function() {
        if (publishDateInput.value < now) {
            alert("Publish date cannot be in the past!");
            publishDateInput.value = now; // Reset to current date
        }
    });
});
</script>