@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Manage Country</h2>
            <form action="{{ route('country.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="country_name">Country Name *</label>
                    <input type="text" name="country_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="status">Status *</label>
                    <select name="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('country.index') }}" class="btn btn-secondary">Back</a>

            </form>
        </div>
    </div>
</div>
@endsection



