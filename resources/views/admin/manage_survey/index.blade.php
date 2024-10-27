@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Manage Survey</h1>
    <a href="{{ route('survey.create') }}" class="btn btn-primary">Add Survey</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Survey Title</th>
                <th>Start Date </th>
                <th>Expire Date </th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($survey as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->survey_title }}</td>
                <td>{{ $record->start_date }}</td>
                <td>{{ $record->end_date }}</td>
                <td>{{ $record->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('survey.edit', $record->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('survey.destroy', $record->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 
