@extends('admin.layouts.master')

@section('title', 'Academy Souvenir')

@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Manage Academy Souvenirs</h3>
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Academy Souvenirs</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Add Academy Souvenirs</h4>
            <a href="{{ route('academy_souvenirs.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add Academy</span>
                    </span>
                </button>
            </a>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
              <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">ID</th>
                            <th class="col">Product Category</th>
                            <th class="col">Product Title</th>
                            <th class="col">Product Type</th>
                            <th class="col">Language</th>
                            <th class="col">Status</th>
                            <th class="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($souvenirs as $souvenir)
                        <tr>
                            <td>{{ $souvenir->id }}</td>
                            <td>{{ $souvenir->product_category }}</td>
                            <td>{{ $souvenir->product_title }}</td>
                            <td>{{ $souvenir->product_type }}</td>
                            <td>{{ $souvenir->language == 1 ? 'English' : 'Hindi' }}</td>
                            <td>{{ $souvenir->product_status ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <a href="{{ route('academy_souvenirs.edit', $souvenir->id) }}"
                                    class="btn bg-success text-white btn-sm">Edit</a>
                                <form action="{{ route('academy_souvenirs.destroy', $souvenir->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary text-white" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
