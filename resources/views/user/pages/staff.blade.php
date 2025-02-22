@include('user.includes.header')



<!-- Page Content -->
<section class="py-2">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">@if(Cookie::get('language') ==
                                '2')घर
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">@if(Cookie::get('language') ==
                                '2')कर्मचारी
                                @else
                                Staff
                                @endif
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center pb-20 mb-20 mb-2">
                    <h3 class="fw-semibold fs-18 mb-0">@if(Cookie::get('language') ==
                                '2')कर्मचारी
                                @else
                                Staff
                                @endif</h3>
                    <div class="contsearch">
                        <form id="form2" action="{{ url()->current() }}" method="GET">
                            <fieldset>
                                <label for="keywords">
                                    <input type="text" id="Keywords" name="keywords" value="{{ request('keywords') }}"
                                        placeholder="Search Staff" fdprocessedid="79mcc"
                                        class="form-control form-control-sm">
                                </label>

                                <label for="btn2">
                                    <input id="btn2" type="submit" value="Submit" class="btn btn-outline-primary btn-sm"
                                        fdprocessedid="6rx09">
                                    <input type="hidden" name="action" value="submit">
                                </label>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="default-table-area members-list">
                    <div class="table-responsive">
                        <table class="table align-middle table-striped" id="myTable">
                            <thead>
                                <tr class="even bg-primary">
                                    <th class="col text-white">#</th>
                                    <th class="col text-white">Name</th>
                                    <th class="col text-white">Designation</th>
                                    <th class="col text-white">Email</th>
                                    <th class="col text-white">Office</th>
                                    <th class="col text-white">Residence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($staff) > 0)
                                @foreach($staff as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->designation }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->country_code }}-{{ $value->std_code }}-{{ $value->phone_pt_office }}</td>
                                    <td>{{ $value->phone_pt_residence }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">No records found</td>
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