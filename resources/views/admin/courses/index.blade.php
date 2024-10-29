@extends('admin.layouts.master')

@section('content')
<h1>Course List</h1>
<a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add Course</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Abbreviation</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->course_name }}</td>
            <td>{{ $course->abbreviation }}</td>
            <td>
                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
