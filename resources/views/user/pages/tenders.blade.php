@include('user.includes.header')



<!-- Page Content -->
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2 mb-4">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Tenders</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="d-sm-flex text-center justify-content-between align-items-center border-bottom pb-20 mb-20">
            <h4 class="fw-semibold fs-18 mb-sm-0 py-4">Tenders</h4>
        </div>
        <div class="default-table-area members-list recent-orders">
            <div class="table-responsive">
                <table class="table align-middle" id="myTable">
                    <thead>
                    <tr class="text-center">
                        <th class="col">#</th>
                        <th class="col">Tender Title</th>
                        <th class="col">Publish Date</th>
                        <th class="col">Last Date</th>
                        <th class="col">Document</th>
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
                            <a href="{{ asset('tender/'.$value->file) }}" target="_blank">Download</a>


                            @else
                            N/A
                            @endif
                        </td>
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