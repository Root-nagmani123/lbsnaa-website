@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2>Quick Links</h2>
    <a href="{{ route('admin.quick_links.create') }}" class="btn btn-primary">Add New Quick Link</a>

    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Quick Link Text</th>
                    <th>Type</th>
                    <th>URL / Document</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quickLinks as $quickLink)
                <tr>
                    <td>{{ $quickLink->text }}</td>
                    <td>{{ $quickLink->url ? 'URL' : 'Document' }}</td>
                    <td>
                        @if ($quickLink->url)
                            <a href="{{ $quickLink->url }}" target="_blank">{{ $quickLink->url }}</a>
                        @elseif ($quickLink->file)
                            <a href="{{ asset('quick-links-files/' . $quickLink->file) }}" target="_blank">View Document</a>
                        @endif
                    </td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="status-toggle" data-id="{{ $quickLink->id }}" {{ $quickLink->status ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <a href="{{ route('admin.quick_links.edit', $quickLink->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.quick_links.destroy', $quickLink->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this link?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
$(document).ready(function () {
        $('.status-toggle').change(function () {
            var sliderId = $(this).data('id');
            var url = '/admin/footer-images/' + sliderId + '/status';

            $.ajax({
                url: url,
                type: 'put',
                data: {
                    _token: '{{ csrf_token() }}',
                    status : 1,
                },
                success: function (response) {
                    alert(response.success);
                },
                error: function (xhr) {
                    alert('Error occurred while toggling status.');
                }
            });
        });
    });
</script>


<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

/* Rounded slider */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>