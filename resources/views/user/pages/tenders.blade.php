@include('user.includes.header')



<!-- Page Content -->
<section class="py-2">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row align-items-center pb-lg-2 mb-4">
            <div class="col-12">
                <div class="bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2 mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tenders</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-9"></div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('user.tenders_archive') }}"
                        class="btn btn-outline-primary fw-semibold btn-sm">Archive</a>
                </div>
            </div>
        </section>
        <!-- Tenders Card -->
        <div class="card bg-white border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <h4 class="fw-semibold fs-18 mb-0">Tenders</h4>
                </div>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tender Title</th>
                                <th>Publish Date</th>
                                <th>Last Date</th>
                                <th>Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($query) > 0)
                            @foreach($query as $key => $value)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->publish_date)->format('d F, Y, H:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->expiry_date)->format('d F, Y, H:i A') }}</td>
                                <td>
                                    @if(!empty($value->file))
                                    <a href="{{ asset('storage/tender/'.$value->file) }}"
                                        class="btn btn-sm btn-outline-primary" target="_blank">Download</a>
                                    @else
                                    <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">No records found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>






@include('user.includes.footer')