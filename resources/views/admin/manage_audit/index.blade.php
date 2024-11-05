@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Manage Audit Logs</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Module Name / Page Name</th>
                <th>Time Stamp</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Login/Logout/Login Failed</th>
                <th>IP Address</th> 
            </tr>
        </thead>

        <tbody>
            @foreach($audits as $index => $audit)
                <tr>
                    <!-- Calculate the index based on current page -->
                    <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->
                    <td>{{ $audit->Module_Name }}</td>
                    <td>{{ date('Y-m-d H:i:s', strtotime($audit->Time_Stamp)) }}</td>
                    <td>{{ $audit->Created_By }}</td>
                    <td>{{ $audit->Updated_By }}</td>
                    <td>{{ $audit->Action_Type }}</td>
                    <td>{{ $audit->IP_Address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
