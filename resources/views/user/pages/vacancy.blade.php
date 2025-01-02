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
                            <a href="{{ route('home')}}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Vacancy</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-12 content-area">
            <h2 class="heading">Vacancy</h2>
            <p></p>



            <table width="100%" border="0" cellspacing="0" align="center" cellpadding="4" class="dataTable">
                <thead>
                    <tr class="even">
                        <th width="5%">S. No.</th>
                        <th width="20%">Job Title</th>
                        <th width="20%">Publish Date</th>
                        <th width="20%">Last Date</th>
                        <th width="15%">Document</th>
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
                        <td colspan="5" class="text-center">No records found</td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>


    </div>
</section>





@include('user.includes.footer')