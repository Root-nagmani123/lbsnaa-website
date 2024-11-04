@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h1>Add Cadre</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cadres.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Page Language</label><br>
            <input type="radio" name="language" value="English" checked> English
            <input type="radio" name="language" value="Hindi"> Hindi
        </div>

        <div class="form-group">
            <label>Cadres Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Cadres Description</label>
            <input type="text" name="description" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1">Active</option>
                <option value="2">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="{{ route('cadres.index') }}" class="btn btn-danger">Cancel</a>
    </form>
@endsection
