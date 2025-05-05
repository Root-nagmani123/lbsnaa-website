@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <!-- <h3 class="mb-sm-0 mb-1 fs-18">Manage Menu</h3> -->
    <ul class="ps-0 mb-0 list-unstyled d-flex justify-content-center">
        <li>
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <i class="ri-home-2-line" style="position: relative; top: -1px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
                <i class="ri-arrow-right-double-line"></i>
                <span>CMS Page</span>
        </li>
        <li>
            <span class="fw-semibold fs-14 heading-font text-dark dot ms-2">Micro Manage Menu</span>
        </li>
    </ul>
</div>
<div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0">Menu List</h4>

            <a href="{{ route('micromenus.create') }}">
                <button class="border-0 btn btn-success py-2 px-3 px-sm-4 text-white fs-14 fw-semibold rounded-3">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line text-white"></i>
                        <span>Add New Menu</span>
                    </span>
                </button>
            </a>
        </div>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="default-table-area members-list">
            <div class="table-responsive">
            <div class="mb-3 text-end">
    <input type="text" id="menuTitleSearch" class="form-control w-25 d-inline-block" placeholder="Search Menu Title">
</div>

            <table class="table align-middle" id="sortableTable">
                    <thead>
                        <tr class="text-center">
                            <th class="col">#</th>
                           
                            <th class="col">Menu Title</th>
                            <th class="col">Research Center</th>
                            <th class="col">Parent Menu</th>
                            <th class="col">Menu Type</th>
                            <th class="col">Content Position</th>
                            <th class="col">Action</th>
                            <th class="col">Status</th>
                        </tr>
                    </thead> 
                    <tbody  id="sortable_micromenu">
                        @foreach($menuTree as $menu)
                        {!! renderMicroMenu($menu) !!}
                        @endforeach
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    $(document).ready(function() {
        $('#menuTitleSearch').on('keyup', function() {
            let value = $(this).val().toLowerCase();
            $('#sortable_micromenu tr').filter(function() {
                $(this).toggle($(this).find('td:nth-child(2)').text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
