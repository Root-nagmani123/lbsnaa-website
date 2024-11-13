<div class="form-group">
    <label>Page Language:</label>
    <div>
        <label><input type="radio" name="language" value="English"
                {{ old('language', $manageTender->language ?? '') == 'English' ? 'checked' : '' }}> English</label>
        <label><input type="radio" name="language" value="Hindi"
                {{ old('language', $manageTender->language ?? '') == 'Hindi' ? 'checked' : '' }}> Hindi</label>
    </div>
    @error('language')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Type:</label>
    <select name="type" class="form-control">
        <option value="">Select</option>
        <option value="Tender" {{ old('type', $manageTender->type ?? '') == 'Tender' ? 'selected' : '' }}>Tender
        </option>
        <option value="Circular" {{ old('type', $manageTender->type ?? '') == 'Circular' ? 'selected' : '' }}>Circular
        </option>
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
    <div class="toolbar">
            <ul class="tool-list">
                <li class="tool">
                    <button type="button" data-command='justifyLeft' class="tool--btn">
                        <i class=' fas fa-align-left'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command='justifyCenter' class="tool--btn">
                        <i class=' fas fa-align-center'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="bold" class="tool--btn">
                        <i class=' fas fa-bold'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="italic" class="tool--btn">
                        <i class=' fas fa-italic'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="underline" class="tool--btn">
                        <i class=' fas fa-underline'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="insertOrderedList" class="tool--btn">
                        <i class=' fas fa-list-ol'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="insertUnorderedList" class="tool--btn">
                        <i class=' fas fa-list-ul'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="createlink" class="tool--btn">
                        <i class=' fas fa-link'></i>
                    </button>
                </li>
            </ul>
        </div>
<textarea type="text" id="output" contenteditable="true" class="form-control"></textarea>


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

<div class="form-group">
    <label>Publish Date:</label>
    <input type="date" name="publish_date" class="form-control"
        value="{{ old('publish_date', $manageTender->publish_date ?? '') }}">
    @error('publish_date')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label>Expiry Date:</label>
    <input type="date" name="expiry_date" class="form-control"
        value="{{ old('expiry_date', $manageTender->expiry_date ?? '') }}">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
        .tool--btn:hover{
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
    </script>
