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
                                <a href="{{ route('home') }}" style="color: #af2910;">@if($_COOKIE['language'] ==
                                    '2')
                                   होम
                                    @else
                                    Home
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @if($_COOKIE['language'] ==
                                '2')
                                संकाय जिम्मेदारी
                                @else
                                Faculty Responsibility
                                @endif
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div> 

        <!-- Tenders Card -->
        <div class="card bg-white border-0 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="row border-bottom   pb-3 mb-3">
                    <div class="col-lg-6">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-semibold fs-18 mb-0">
                                @if($_COOKIE['language'] ==
                                '2')
                                संकाय जिम्मेदारी
                                @else
                                Faculty Responsibility
                                @endif</h4>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contsearch float-end">
                        @php
    $lang = isset($_COOKIE['language']) && $_COOKIE['language'] == '2' ? 'hi' : 'en';
@endphp

                <form id="form2" action="{{ route('user.faculty_responsibility') }}" method="GET">
                    <fieldset>
                        <label class="form-label">
                            {{ $lang == 'hi' ? 'कीवर्ड द्वारा खोजें:' : 'Search by Keywords:' }}
                        </label>

                        <label for="keywords">
                            <input 
                                type="text" 
                                id="Keywords" 
                                name="keywords"
                                value="{{ request('keywords') }}" 
                                placeholder="{{ $lang == 'hi' ? 'संकाय खोजें' : 'Search Faculty' }}"
                                class="form-control text-dark ps-5 h-58">
                        </label>

                        <label for="btn2">
                            <input 
                                id="btn2" 
                                type="submit" 
                                class="btn btn-success" 
                                value="{{ $lang == 'hi' ? 'जमा करें' : 'Submit' }}">
                        </label>

                        <a href="{{ route('user.faculty_responsibility') }}" class="btn btn-warning">
                            {{ $lang == 'hi' ? 'रीसेट करें' : 'Reset' }}
                        </a>
                    </fieldset>
                </form>


                        </div>
                    </div>
                </div>


                <!-- Table Section -->
                <div class="table-responsive" id="skip_to_main_content">
                    <table class="table table-striped align-middle">
                        <thead class="table">
                            <tr class="bg-primary">
                                <th class="col text-white">@if($_COOKIE['language'] ==
                                    '2')
                                    आनुक्रमिक
                                    @else
                                    #
                                    @endif
                                </th>
                                <th class="col text-white">@if($_COOKIE['language'] ==
                                    '2')
                                    शीर्षक
                                    @else
                                    Title
                                    @endif
                                </th>
                                <th class="col text-white">
                                    @if($_COOKIE['language'] ==
                                    '2')
                                    प्रभारी अधिकारी
                                    @else
                                    Officer Incharge
                                    @endif
                                </th>
                                <th class="col text-white">
                                    @if($_COOKIE['language'] ==
                                    '2')
                                    उप प्रभारी
                                    @else
                                    Deputy Incharge
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td> <!-- Serial Number -->
                                <td>
    {{ $lang == 'hi' && !empty($value->name_in_hindi) ? $value->name_in_hindi : $value->name }}
</td> <!-- Faculty Name -->
                                <td>
                                    @if(count($value->Officer_Incharge) > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach($value->Officer_Incharge as $officer)
                                        <li>
                                            <strong>{{ $officer['section_title'] }}</strong>
                                        </li>
                                        <li class="text-muted">
                                        {{ implode(', ', $officer['categories']) }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <span class="text-muted">@if($_COOKIE['language'] ==
                                        '2')
                                        ---
                                        @else
                                        ---
                                        @endif
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if(count($value->Deputy_Incharge) > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach($value->Deputy_Incharge as $deputy)
                                        <li>
                                            <strong>{{ $deputy['section_title'] }}</strong>
                                        </li>
                                        <li class="text-muted">
                                        {{ implode(', ', $deputy['categories']) }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <span class="text-muted">@if($_COOKIE['language'] ==
                                        '2')
                                        ---
                                        @else
                                        ---
                                        @endif</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    @if($_COOKIE['language'] ==
                                    '2')
                                    कोई रिकॉर्ड नहीं मिला
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