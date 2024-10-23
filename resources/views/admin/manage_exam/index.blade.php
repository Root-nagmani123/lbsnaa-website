@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Exam</h1>
    <a href="{{ route('exam.create') }}" class="btn btn-primary">Add Exam</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Exam Code</th>
                <th>Exam Description</th>
                <th>Transaction Date</th>
                <th>Preliminary Flag</th>
                <th>Main Flag</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
            <tr>
                <td>{{ $exam->id }}</td>
                <td>{{ $exam->exam_code }}</td>
                <td>{{ $exam->exam_description }}</td>
                <td>{{ $exam->transaction_date }}</td>
                <td>{{ $exam->preliminary_flag == 1 ? 'Yes' : 'No' }}</td>
                <td>{{ $exam->main_flag == 1 ? 'Yes' : 'No' }}</td>
                <td>{{ $exam->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('exam.edit', $exam->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('exam.destroy', $exam->id) }}" method="POST" style="display:inline;">
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
