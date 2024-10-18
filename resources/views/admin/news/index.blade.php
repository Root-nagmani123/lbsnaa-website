@extends('layouts.admin')

@section('content')
<h1>News and Updates</h1>
<a href="{{ route('admin.news.create') }}" class="btn btn-primary">Add News</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Start Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($news as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>{{ $item->start_date }}</td>
            <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
            <td>
                <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline;">
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
