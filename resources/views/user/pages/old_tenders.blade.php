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
                                <a href="{{ route('home') }}" class="text-primary">
                                    @if($_COOKIE['language'] ==
                                    '2')होम
                                    @else
                                    Home
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item" >
                                <a href="{{ route('user.tenders') }}" class="text-primary">
                                    @if($_COOKIE['language'] ==
                                    '2')नाज़ुक
                                    @else
                                    Tender
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @if($_COOKIE['language'] ==
                                '2')पुरालेख निविदाएं
                                @else
                                Archive Tenders
                                @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="contsearch" id="skip_to_main_content">
            <form id="form2" method="GET" action="{{ route('user.tenders_archive') }}">
                <div class="row mb-4">
                    <div class="col-lg-4">
                        <label class="form-label" for="Keywords">
                            @if($_COOKIE['language'] ==
                            '2')खोज :
                            @else
                            Search :
                            @endif
                        </label>
                        <input type="text" id="Keywords" name="keywords" value="{{ request('keywords') }}"
                            placeholder="Keywords Search" class="form-control text-dark ps-5 h-58">
                    </div>
                    <div class="col-lg-4">
                        <label for="year" class="form-label">
                            @if($_COOKIE['language'] ==
                            '2')वर्ष
                            @else
                            Year
                            @endif
                        </label>
                        <select name="year" id="year" class="form-select ps-5 text-dark h-58">
                            @foreach($years as $year)
                            <option value="{{ $year }}" @if($year==request('year')) selected @endif>{{ $year }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-lg-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary fw-bold w-100">@if($_COOKIE['language']
                            ==
                            '2')जमा करना
                            @else
                            Submit
                            @endif
                        </button>
                        <a href="{{ route('user.tenders_archive') }}" class="btn btn-warning fw-bold w-100">
                            @if($_COOKIE['language'] ==
                            '2')रीसेट करें
                            @else
                            Reset
                            @endif
                        </a>

                    </div>
                </div>
            </form>
        </div>
        <!-- Tenders Card -->
        <div class="card bg-white border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <h4 class="fw-semibold fs-18 mb-0">
                        @if($_COOKIE['language'] ==
                        '2')निविदाओं
                        @else
                        Tenders
                        @endif
                    </h4>
                </div>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>
                                    @if($_COOKIE['language'] ==
                                    '2')निविदा शीर्षक
                                    @else
                                    Tender Title
                                    @endif
                                </th>
                                <th>
                                    @if($_COOKIE['language'] ==
                                    '2')प्रकाशित तिथि
                                    @else
                                    Publish Date
                                    @endif
                                </th>
                                <th>
                                    @if($_COOKIE['language'] ==
                                    '2')अंतिम तिथि
                                    @else
                                    Last Date
                                    @endif
                                </th>
                                <th>
                                    @if($_COOKIE['language'] ==
                                    '2')दस्तावेज़
                                    @else
                                    Document
                                    @endif
                                </th>
                                <th>
                                    @if($_COOKIE['language'] ==
                                    '2')शुद्धिपत्र
                                    @else
                                    Corrigendum
                                    @endif
                                </th>
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
                                        class="btn btn-sm btn-primary" target="_blank">
                                        @if($_COOKIE['language'] ==
                                        '2')डाउनलोड करना
                                        @else
                                        Download
                                        @endif
                                    </a>
                                    @else
                                    <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($value->corrigendum))
                                    <a href="{{ asset('storage/tender/'.$value->corrigendum) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        target="_blank">@if($_COOKIE['language'] ==
                                        '2')डाउनलोड करना
                                        @else
                                        Download
                                        @endif</a>
                                    @else
                                    <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    @if($_COOKIE['language'] ==
                                    '2')कोई रिकॉर्ड नहीं मिला
                                    @else
                                    No records found
                                    @endif
                                </td>
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