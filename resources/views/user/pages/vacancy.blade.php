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
                                @if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">
                                @if(Cookie::get('language') ==
                                '2')रिक्ति
                                @else
                                Vacancy
                                @endif
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 content-area">
            <h2 class="heading">@if(Cookie::get('language') ==
                '2')रिक्ति
                @else
                Vacancy
                @endif</h2>
            <p></p>



            <table width="100%" border="0" cellspacing="0" align="center" cellpadding="4" class="dataTable">
                <thead>
                    <tr class="even">
                        <th width="5%">#</th>
                        <th width="20%">
                        @if(Cookie::get('language') ==
                            '2')पद का नाम
                            @else
                            Job Title
                            @endif
                            </th>
                        <th width="20%">
                        @if(Cookie::get('language') ==
                            '2')प्रकाशित तिथि
                            @else
                            Publish Date
                            @endif
                            </th>
                        <th width="20%">
                        @if(Cookie::get('language') ==
                            '2')अंतिम तिथि
                            @else
                            Last Date
                            @endif
                            </th>
                        <th width="15%">
                        @if(Cookie::get('language') ==
                            '2')दस्तावेज़
                            @else
                            Document
                            @endif
                            </th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($query) > 0)
                    @foreach($query as $key => $value)
                    <tr>
                        <td style="padding-left:10px;">{{ $loop->iteration }}</td>
                        <td>{{ $value->job_title }}</td>
                        <td>{{ \Carbon\Carbon::parse($value->publish_date)->format('d F, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($value->expiry_date)->format('d F, Y') }}</td>
                        <td>
                            @if(!empty($value->document_upload))
                            <a href="{{ asset('uploads/' . $value->document_upload) }}" target="_blank">Download</a>
                            @else
                            N/A
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if(Cookie::get('language') ==
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





@include('user.includes.footer')