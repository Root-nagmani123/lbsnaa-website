@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .switch {
    position: relative;
    display: inline-block;
    width: 34px;
    height: 20px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 14px;
    width: 14px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(14px);
}

    </style>
<div class="container">
    <h1>Set Permissions for {{ $user->name }}</h1>
    <form action="{{ route('users.permissions.update') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Parent</th>
                    <th>Child</th>
                    <th>Permission</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                <tr>
                    <td>{{ $module->parent }}</td>
                    <td>{{ $module->child }}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="permissions[{{ $module->id }}]" value="1"
                                {{ isset($permissions[$module->id]) && $permissions[$module->id] ? 'checked' : '' }}>
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Save Permissions</button>
    </form>
</div>
@endsection
