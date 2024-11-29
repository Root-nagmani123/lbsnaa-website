@extends('admin.layouts.master')
@section('title', 'Admin Dashboard')


@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Training Program</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('Managenews.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Training Program - Micro</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Program List</h4>
            <a href="{{ route('training-programs.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Program</span>
                    </span>
                </button>
            </a>
        </div>
              <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th>
                            <th class="col">Research Centre</th>
                            <th class="col">Program Title</th>
                            <th class="col">Venue</th>
                            <th class="col">Co-ordinator</th>
                            <th class="col">Start Date</th>
                            <th class="col">End Date</th>
                            <th class="col">Language</th>
                            <th class="col">Page Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $program)
                <tr>
                <td>{{ $loop->iteration }}</td> <!-- Auto-incrementing index -->

                    <td>{{ $program->research_centre_name }}</td>

                    <td>{{ $program->program_name }}</td>
                    <td>{{ $program->venue }}</td>
                    <td>{{ $program->program_coordinator }}</td>
                    <td>{{ $program->start_date }}</td>
                    <td>{{ $program->end_date }}</td>
                    <td>
                        @if ($program->language == 1)
                            English
                        @else ($program->language == 2)
                            Hindi
                        @endif
                    </td>
                            <td>
                                <a href="{{ route('training-programs.edit', $program->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('training-programs.destroy', $program->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            <td><div class="form-check form-switch">
            <input class="form-check-input status-toggle" type="checkbox" role="switch"  data-table="micro_manage_training_programs" 
            data-column="page_status" data-id="{{$program->id}}" {{$program->page_status ? 'checked' : ''}}>
          </div></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
