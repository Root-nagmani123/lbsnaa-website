@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h2>Footer Images</h2>
        <a href="{{ route('admin.footer_images.create') }}" class="btn btn-primary">Add New Footer Image</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($footerImages as $footerImage)
                <tr>
                    <td><img src="{{ asset('footer-images/' . $footerImage->image) }}" width="100"></td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" class="status-toggle" data-id="{{ $footerImage->id }}" {{ $footerImage->status ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td>
                        <a href="{{ route('admin.footer_images.edit', $footerImage->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.footer_images.destroy', $footerImage->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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