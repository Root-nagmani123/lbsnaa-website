@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
<h2>Sliders</h2>
<a href="{{ route('slider.create') }}" class="btn btn-success">Add New Slider</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Text</th>
            <th>Description</th>
            <th>Language</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sliders as $slider)
        <tr>
            <td>{{ $slider->id }}</td>
            <td><img src="{{ asset('storage/' . $slider->slider_image) }}" width="100"></td>
            <td>{{ $slider->slider_text }}</td>
            <td>{{ $slider->slider_description }}</td>
            <td>
                @if ($slider->language == 1)
                    English
                @elseif ($slider->language == 2)
                    Hindi
                @endif
            </td>

            <td>
            @if ($slider->status == 1)
                <span class="badge bg-warning bg-opacity-10 text-warning py-2 fw-semibold text-center">Draft</span>
            @elseif ($slider->status == 2)
                <span class="badge bg-primary bg-opacity-10 text-primary py-2 fw-semibold text-center">Approved</span>
            @elseif ($slider->status == 3)
                <span class="badge bg-success bg-opacity-10 text-success py-2 fw-semibold text-center">Publish</span>
            @endif
        </td>

            <td>
                <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
