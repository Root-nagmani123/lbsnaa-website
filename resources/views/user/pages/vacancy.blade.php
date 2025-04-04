@include('user.includes.header')



<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">
                                @if($_COOKIE['language'] ==
                                '2')होम
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                        @if($_COOKIE['language'] ==
                                '2')रिक्ति
                                @else
                                Vacancy
                                @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <section class="py-4" id="skip_to_main_content">
           <div class="container-fluid">
           <div class="row mb-3">
                <div class="col-md-9">
                    <h2 class="heading mb-3 text-primary fw-bold">@if($_COOKIE['language'] ==
                        '2')रिक्ति
                        @else
                        Vacancy
                        @endif</h2>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('user.vacancy_archive') }}" class="btn btn-outline-primary fw-semibold btn-sm">
                        @if($_COOKIE['language'] ==
                        '2')पुरालेख
                        @else
                        Archive
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-md-12 content-area">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <th class="col text-white">#</th>
                            <th class="col text-white">@if($_COOKIE['language'] ==
                        '2')पद का नाम
                        @else
                        Job Title
                        @endif</th>
                            <th class="col text-white">@if($_COOKIE['language'] ==
                        '2')प्रकाशित तिथि
                        @else
                        Publish Date
                        @endif</th>
                            <th class="col text-white">@if($_COOKIE['language'] ==
                        '2')अंतिम तिथि
                        @else
                        Last Date
                        @endif</th>
                            <th class="col text-white">@if($_COOKIE['language'] ==
                        '2')दस्तावेज़
                        @else
                        Document
                        @endif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($query) > 0)
                        @foreach($query as $key => $value)
                        <tr>
                            <td style="padding-left:10px;">{{ $loop->iteration }}</td>
                            <td>{{ $value->job_title }}</td>
                            <td>
                            @php
                                \Carbon\Carbon::setLocale($_COOKIE['language'] == '2' ? 'hi' : 'en');
                                $publishDate = \Carbon\Carbon::parse($value->publish_date)->translatedFormat('d F, Y');
                                $expiryDate = \Carbon\Carbon::parse($value->expiry_date)->translatedFormat('d F, Y');
                            @endphp

                            {{ $publishDate }}
                        </td>
                        <td>
                            {{ $expiryDate }}
                        </td>
                            <td>
                                @if(!empty($value->document_upload))
                                <a href="{{ asset('storage/' . $value->document_upload) }}" target="_blank">Download</a>
                                @else
                                N/A
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5" class="text-center">
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
        </section>



    </div>
</section>





@include('user.includes.footer')