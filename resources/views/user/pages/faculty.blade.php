@include('user.includes.header')



<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-light rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #af2910;">
                            Faculty
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                    <h3 class="fw-semibold fs-18 mb-0">Inhouse Faculty</h3>
                    <div class="contsearch">
                        <form id="form2" action="{{ url()->current() }}" method="GET">
                            <fieldset class="d-flex align-items-center">
                                <input type="text" id="Keywords" name="keywords" value="{{ request('keywords') }}"
                                    placeholder="Search Faculty" class="form-control form-control-sm me-2">
                                <input id="btn2" type="submit" value="Submit" class="btn btn-outline-primary btn-sm">
                                <input type="hidden" name="action" value="submit" class="form-control fw-bold">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="default-table-area members-list">
                    <div class="table-responsive">
                        <table class="table align-middle" id="myTable">
                            <thead>
                                <tr class="text-center">
                                    <th class="col">#</th>
                                    <th class="col">Name</th>
                                    <th class="col">Designation</th>
                                    <th class="col">Email</th>
                                    <th class="col">Office</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($faculty) > 0)
                                @foreach($faculty as $key => $value)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->designation }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->country_code }}-{{ $value->std_code }}-{{ $value->phone_pt_office }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center">No records found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






@include('user.includes.footer')