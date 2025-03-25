@include('user.includes.header')



<!-- Page Content -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!-- image -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home')}}" style="color: #af2910;">@if($_COOKIE['language'] ==
                                '2')घर
                                @else
                                Home
                                @endif</a>
                        </li>
                        <li class="breadcrumb-item">

                            @if($_COOKIE['language'] ==
                            '2')प्रशिक्षण कैलेंडर
                            @else
                            Traning Calendar
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-2" id="skip_to_main_content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="mb-4">
                <h2 class="h1 fw-bold text-primary">
                    @if($_COOKIE['language'] ==
                    '2')प्रशिक्षण कैलेंडर
                    @else
                    Traning Calendar
                    @endif
                </h2>
            </div>
        </div>
        <form id="form2" action="{{ url()->current() }}" method="GET">
            <div class="row mb-4">
                <div class="col-lg-1">
                    <label for="select_year" class="form-label"> @if($_COOKIE['language'] ==
                        '2')फ़िल्टर वर्ष
                        @else
                        Filter Year
                        @endif
                    </label>
                </div>
                <div class="col-lg-3">
                @php
$currentYear = date('Y'); // Current year
$currentMonth = date('m'); // Current month
$startYear = $currentYear - 3; // Start year (adjust as needed)

// Get selected year from request
$selectedYear = request()->input('select_year');

// Agar user ne select nahi kiya toh default financial year set karein
if (!$selectedYear) {
    if ($currentMonth >= 4) {
        $selectedYear = $currentYear + 1; // Financial year (current - next)
    } else {
        $selectedYear = $currentYear; // Previous - current year
    }
}
@endphp

<select name="select_year" id="select_year" class="form-control ps-5 text-dark h-58">
    <option value="">Select Year</option>
    @for ($year = $startYear; $year <= $currentYear + 3; $year++)
        <option value="{{ $year }}" {{ ($year == $selectedYear) ? 'selected' : '' }}>
            {{ $year - 1 }} - {{ $year }}
        </option>
    @endfor
</select>
                </div>
                <div class="col-lg-3">
                    <button type="submit" id="btn2" class="btn btn-outline-primary">@if($_COOKIE['language'] ==
                        '2')जमा करना
                        @else
                        Submit
                        @endif</button>
                </div>
            </div>
        </form>

        <div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
        <div class="default-table-area members-list">
            <div class="table-responsive">
                <table class="table align-middle table-bordered" id="myTable">
                    @php
                        // Determine current year and month
                        $selectedYear = request()->input('select_year');
                        if (!$selectedYear) {
    $currentYear = date('Y');
    $currentMonth = date('m');

    if ($currentMonth >= 4) {
        $startYear = $currentYear;
        $endYear = $currentYear + 1;
    } else {
        $startYear = $currentYear - 1;
        $endYear = $currentYear;
    }
} else {
    // Agar user ne year select kiya hai toh usko financial year ka start-end banayein
    $startYear = $selectedYear - 1;  // Financial Year Start
    $endYear = $selectedYear;        // Financial Year End
}


                        // Months for the financial year
                        $months = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];
                    @endphp

                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>
                                @if ($_COOKIE['language'] == '2')
                                    कोर्स का नाम
                                @else
                                    Course Name
                                @endif
                            </th>
                            <th>
                                @if ($_COOKIE['language'] == '2')
                                    सहायता अनुभाग
                                @else
                                    Support Section
                                @endif
                            </th>
                            <th>
                                @if ($_COOKIE['language'] == '2')
                                    पाठ्यक्रम समन्वयक
                                @else
                                    Course Coordinator
                                @endif
                            </th>
                            <th>
                                @if ($_COOKIE['language'] == '2')
                                    अवधि
                                @else
                                    Duration
                                @endif
                            </th>
                            {{-- Month headers for the table --}}
                            @foreach ($months as $index => $month)
                                <th>{{ $month }} {{ $index < 9 ? $startYear : $endYear }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @php $serial = 1; @endphp
                        {{-- Loop through parent categories --}}
                        @foreach ($organizedCategories as $parentCategoryId => $parentCategory)
                            {{-- Parent Category Row --}}
                            <tr>
                                <td></td>
                                <td colspan="16" class="text-dark fw-bold">
                                    {{ $parentCategory['name'] }}
                                </td>
                            </tr>

                            {{-- Loop through subcategories under this parent category --}}
                            @foreach ($parentCategory['subcategories'] as $subcategoryId => $subcategory)
                                {{-- Subcategory Row --}}
                                <tr>
                                    <td></td>
                                    <td colspan="16" class="text-dark fw-bold">
                                        -- {{ $subcategory['name'] }}
                                    </td>
                                </tr>

                                {{-- Loop through courses under this subcategory --}}
                                @foreach ($subcategory['courses'] as $course)
                                    {{-- Calculate Duration --}}
                                    @php
                                        $courseStart = strtotime($course['course_start_date']);
                                        $courseEnd = strtotime($course['course_end_date']);
                                        $durationInDays = ($courseEnd - $courseStart) / (60 * 60 * 24) + 1;

                                        if ($durationInDays < 7) {
                                            $duration = $durationInDays . ' day' . ($durationInDays > 1 ? 's' : '');
                                        } else {
                                            $durationInWeeks = ceil($durationInDays / 7);
                                            $duration = $durationInWeeks . ' week' . ($durationInWeeks > 1 ? 's' : '');
                                        }
                                    @endphp

                                    {{-- Course Row --}}
                                    <tr>
                                        <td style="background-color: {{ $subcategory['color'] }};">{{ $serial++ }}</td>
                                        <td style="background-color: {{ $subcategory['color'] }};">
                                            {{ $course['course_name'] }}
                                        </td>
                                        <td style="background-color: {{ $subcategory['color'] }};">
                                            {{ $course['support_section'] }}
                                        </td>
                                        <td style="background-color: {{ $subcategory['color'] }};">
                                            {{ $course['coordinator_id'] }}
                                        </td>
                                        <td style="background-color: {{ $subcategory['color'] }};">
                                            @if ($course['course_start_date'] && $course['course_end_date'])
                                                {{ $duration }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        {{-- Month Columns --}}
                                        @for ($month = 4; $month <= 15; $month++)
                                            @php
                                                $cellDate = ($month <= 12 ? "$startYear-" : "$endYear-") . str_pad(($month - 1) % 12 + 1, 2, '0', STR_PAD_LEFT);
                                                $courseStartDate = date('Y-m', strtotime($course['course_start_date']));
                                                $courseEndDate = date('Y-m', strtotime($course['course_end_date']));
                                                $isWithinDuration = ($courseStartDate <= $cellDate) && ($courseEndDate >= $cellDate);
                                            @endphp
                                            <td class="center" style="
                                                @if ($isWithinDuration) background-color: {{ $subcategory['color'] }}; @endif
                                            ">
                                                @if ($courseStartDate == $cellDate && $courseEndDate == $cellDate)
                                                    {{ date('d', strtotime($course['course_start_date'])) }} -
                                                    {{ date('d', strtotime($course['course_end_date'])) }}
                                                @elseif ($courseStartDate == $cellDate)
                                                    {{ date('d', strtotime($course['course_start_date'])) }} -
                                                @elseif ($courseEndDate == $cellDate)
                                                    {{ date('d', strtotime($course['course_end_date'])) }}
                                                @endif
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


                </div>
            </div>
        </div>
</section>



@include('user.includes.footer')