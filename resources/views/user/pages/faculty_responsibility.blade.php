@include('user.includes.header')



<!-- Page Content -->
<section class="py-2">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="row align-items-center pb-lg-2 mb-4">
            <div class="col-12">
                <div class="bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2 mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Faculty Responsibility</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    
        <!-- Tenders Card -->
        <div class="card bg-white border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <h4 class="fw-semibold fs-18 mb-0">Faculty Responsibility</h4>
                </div>
                <div class="contsearch">
                <form id="form2" action="{{ route('user.faculty_responsibility') }}" method="GET">
    <fieldset>
        <label class="txt">Search by Keywords:</label>
        <label for="keywords">
            <input type="text" id="Keywords" name="keywords" value="{{ urlencode(request('keywords')) }}" placeholder="Search Faculty">
        </label>
        <label for="btn2">
            <input id="btn2" type="submit" value="Submit" class="btn">
        </label>
        <a href="{{ route('user.faculty_responsibility') }}" class="btn btn-primary">Reset</a>
    </fieldset>
</form>

	</div>
                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>Serial</th>
                                <th>Title</th>
                                <th>Officer Incharge</th>
                                <th>Deputy Incharge</th>
                            </tr>
                        </thead>
                        <tbody>
    @if(count($data) > 0)
        @foreach($data as $key => $value)
            <tr class="text-center">
                <td>{{ $key + 1 }}</td> <!-- Serial Number -->
                <td>{{ $value->name }}</td> <!-- Faculty Name -->
                <td>
                    @if(count($value->Officer_Incharge) > 0)
                        <ul class="list-unstyled mb-0">
                            @foreach($value->Officer_Incharge as $officer)
                                <li>
                                    <strong>{{ $officer['section_title'] }}</strong>
                                    <br>
                                    <span class="text-muted">
                                        {{ implode(', ', $officer['categories']) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted">No Responsibilities</span>
                    @endif
                </td>
                <td>
                    @if(count($value->Deputy_Incharge) > 0)
                        <ul class="list-unstyled mb-0">
                            @foreach($value->Deputy_Incharge as $deputy)
                                <li>
                                    <strong>{{ $deputy['section_title'] }}</strong>
                                    <br>
                                    <span class="text-muted">
                                        {{ implode(', ', $deputy['categories']) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted">No Responsibilities</span>
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