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
                <!-- <textarea type="text" id="description" contenteditable="true" class="form-control"></textarea> -->
                <textarea class="form-control" id="description" placeholder="Enter the Description" name="description" rows="5">{{ old('description', $manageTender->description ?? '') ?? '' }}</textarea>
            </div>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
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
                    <option value="1" {{ old('status', $manageTender->status ?? '') == '1' ? 'selected' : '' }}>Draft
                    </option>
                    <option value="2" {{ old('status', $manageTender->status ?? '') == '2' ? 'selected' : '' }}>Approval
                    </option>
                    <option value="3" {{ old('status', $manageTender->status ?? '') == '3' ? 'selected' : '' }}>Publish
                    </option>
                </select>
            </div>
            @error('status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

</div>
<script src="{{ asset('admin_assets/js/ckeditor.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
    console.error( error );
    });
</script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="texteditor.css">
<style>
.tool-list {
    display: flex;
    flex-flow: row nowrap;
    list-style: none;
    padding: 0;
    overflow: hidden;
    gap: 10px;
    border: 1px solid #333;
    padding: 20px;
    border-radius: 5px;
    background-color: white;
}

.tool--btn {
    display: block;
    border: none;
    border-radius: 5px;
    height: 30px;
    width: 30px;
    font-size: 16px;
    cursor: pointer;
}

.tool--btn:hover {
    background-color: #dddddd;
}

#output {
    height: 200px;
    padding: 1rem;
    border: 1px solid #333;
    border-radius: 5px;
    background-color: white;
}
</style>
<script src="texteditor.js"></script>
<script>
let output = document.getElementById('output');
let buttons = document.getElementsByClassName('tool--btn');
for (let btn of buttons) {
    btn.addEventListener('click', () => {
        let cmd = btn.dataset['command'];
        if (cmd === 'createlink') {
            let url = prompt("Enter the link here: ", "http:\/\/");
            document.execCommand(cmd, false, url);
        } else {
            document.execCommand(cmd, false, null);
        }
    })
}
</script> -->