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
                            <a href="#" style="color: #af2910;">Traning Calendar</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="p-2">
    <div class="container-fluid">
    <div class="card bg-white border-0 rounded-10 mb-4">
    <div class="card-body p-4">
      <div class="default-table-area members-list">
      <div class="table-responsive">
    <table class="table align-middle table-bordered" id="myTable">
                @php
                // Determine current year and month
                $currentYear = date('Y');
                $currentMonth = date('m');

                // Set the start and end year for the table
                if ($currentMonth >= 4) {
                    // If current month is April or later, start from April of the current year to March of the next year
                    $startYear = $currentYear;
                    $endYear = $currentYear + 1;
                } else {
                    // If current month is before April, start from April of the previous year to March of the current year
                    $startYear = $currentYear - 1;
                    $endYear = $currentYear;
                }

                // Generate the months and years for table header
                $months = [
                    'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'
                ];
            @endphp

            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Course Name</th>
                    <th>Support Section</th>
                    <th>Course Coordinator</th>
                    <th>Duration</th>
                    {{-- Generate the month headers based on the current year and month --}}
                    @foreach ($months as $index => $month)
                        @if ($index < 9) {{-- April to December --}}
                            <th>{{ $month }} {{ $startYear }}</th>
                        @else {{-- January to March (of the next year) --}}
                            <th>{{ $month }} {{ $endYear }}</th>
                        @endif
                    @endforeach
                </tr>
            </thead>

            <tbody>
    @php
        $serial = 1;
    @endphp

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
                    $durationInDays = ($courseEnd - $courseStart) / (60 * 60 * 24) + 1; // Calculate number of days including both start and end dates
                    if ($durationInDays < 7) {
                        $duration = $durationInDays . ' day' . ($durationInDays > 1 ? 's' : '');
                    } else {
                        $durationInWeeks = ceil($durationInDays / 7); // Round up to show weeks
                        $duration = $durationInWeeks . ' week' . ($durationInWeeks > 1 ? 's' : '');
                    }
                @endphp

                {{-- Course Row --}}
                <tr>
                    {{-- Apply color to the following columns: Serial, Course Name, Support Section, Course Coordinator, Duration --}}
                    <td style="background-color: {{ $subcategory['color'] }};">{{ $serial++ }}</td>
                    <td style="background-color: {{ $subcategory['color'] }};">{{ $course['course_name'] }}</td>
                    <td style="background-color: {{ $subcategory['color'] }};">{{ $course['support_section'] }}</td>
                    <td style="background-color: {{ $subcategory['color'] }};">Course Coordinator Here</td> <!-- Add logic to fetch coordinator if available -->
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
                            $cellDate = ($month <= 12) ? "2024-" . str_pad($month, 2, '0', STR_PAD_LEFT) : "2025-" . str_pad($month - 12, 2, '0', STR_PAD_LEFT);
                            $courseStartDate = date('Y-m', strtotime($course['course_start_date']));
                            $courseEndDate = date('Y-m', strtotime($course['course_end_date']));

                            // Determine if the current cell is within the duration of the course
                            $isWithinDuration = ($courseStartDate <= $cellDate) && ($courseEndDate >= $cellDate);
                        @endphp
                        <td class="center" style="
                            @if ($isWithinDuration)
                                background-color: {{ $subcategory['color'] }};
                            @endif
                        ">
                            {{-- Display start date and end date appropriately --}}
                            @if ($courseStartDate == $cellDate && $courseEndDate == $cellDate)
                                {{ date('d', strtotime($course['course_start_date'])) }} - {{ date('d', strtotime($course['course_end_date'])) }}
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
</section>



@include('user.includes.footer')