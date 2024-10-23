@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Manage Exam</h2>
            <form action="{{ route('exam.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="exm_code">Exam Code *</label>
                    <input type="text" name="exm_code" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="exm_desc">Exam Description</label>
                    <input type="text" name="exm_desc" class="form-control">
                </div>

                <div class="form-group">
                    <label for="exm_user_id">User ID *</label>
                    <input type="text" name="exm_user_id" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="exm_date">Transaction Date *</label>
                    <input type="date" name="exm_date" id="startdate" class="form-control"  >
                </div>

                <div class="form-group">
                    <label for="preliminary_flag">Preliminary Flag *</label><br>
                    <input type="radio" name="preliminary_flag" value="1" required> Yes
                    <input type="radio" name="preliminary_flag" value="0" required> No
                </div>

                <div class="form-group">
                    <label for="main_flag">Main Flag *</label><br>
                    <input type="radio" name="main_flag" value="1" required> Yes
                    <input type="radio" name="main_flag" value="0" required> No
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('exam.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection
