@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Exam</h1>
    <form action="{{ route('exam.update', $exams->id) }}" method="post">
        @csrf

        <div class="form-group">
            <label for="exm_code">Exam Code *</label>
            <input type="text" name="exm_code" class="form-control" value="{{ $exams->exam_code }}" required>
        </div>

        <div class="form-group">
            <label for="exm_desc">Exam Description</label>
            <input type="text" name="exm_desc" class="form-control" value="{{ $exams->exam_description }}">
        </div>

        <div class="form-group">
            <label for="exm_user_id">User ID *</label>
            <input type="number" name="exm_user_id" class="form-control" value="{{ $exams->user_id }}" required>
        </div>

        <div class="form-group">
            <label for="exm_date">Transaction Date *</label>
            <input type="date" name="exm_date" id="exm_date" class="form-control" value="{{ $exams->transaction_date }}" >
        </div>

        <div class="form-group">
            <label for="preliminary_flag">Preliminary Flag *</label>
            <div>
                <input type="radio" name="preliminary_flag" value="1" {{ $exams->preliminary_flag == 1 ? 'checked' : '' }}> Yes
                <input type="radio" name="preliminary_flag" value="0" {{ $exams->preliminary_flag == 0 ? 'checked' : '' }}> No
            </div>
        </div>

        <div class="form-group">
            <label for="main_flag">Main Flag *</label>
            <div>
                <input type="radio" name="main_flag" value="1" {{ $exams->main_flag == 1 ? 'checked' : '' }}> Yes
                <input type="radio" name="main_flag" value="0" {{ $exams->main_flag == 0 ? 'checked' : '' }}> No
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status *</label>
            <select name="status" class="form-control" required>
                <option value="1" {{ $exams->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $exams->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('exam.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
