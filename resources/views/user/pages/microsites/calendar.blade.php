

    @include('user.pages.microsites.includes.header')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <title>Calendar</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .calendar { width: 100%; max-width: 600px; margin: 20px auto; text-align: center; }
        .calendar table { width: 100%; border-collapse: collapse; }
        .calendar th, .calendar td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        .calendar th { background-color: #f4f4f4; }
        .calendar td.empty { background-color: #eee; }
        .calendar td.today { background-color: #ffeb3b; font-weight: bold; } /* Highlight for today's date */
    </style>
</head>
<body>
    <div class="calendar">
        <h1>Calendar</h1>
        <div>
            <!-- Navigation Buttons -->
            <a href="{{ route('calendar', ['month' => $month - 1, 'year' => $year]) }}">&lt;&lt;</a>
            <select onchange="window.location.href = this.value">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ route('calendar', ['month' => $i, 'year' => $year]) }}" {{ $i == $month ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromDate(null, $i, 1)->format('F') }}
                    </option>
                @endfor
            </select>
            <select onchange="window.location.href = this.value">
                @for ($i = 2020; $i <= 2030; $i++)
                    <option value="{{ route('calendar', ['month' => $month, 'year' => $i]) }}" {{ $i == $year ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            <a href="{{ route('calendar', ['month' => $month + 1, 'year' => $year]) }}">&gt;&gt;</a>

            <!-- Clear Button -->
            <button onclick="window.location.href = '{{ route('calendar') }}'">Clear</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentDay = 1;
                    $today = \Carbon\Carbon::now();
                    $isToday = $today->format('Y-m') === "$year-$month";
                @endphp
                @for ($i = 0; $i < ceil(($daysInMonth + $startDay) / 7); $i++)
                    <tr>
                        @for ($j = 0; $j < 7; $j++)
                            @if (($i === 0 && $j < $startDay) || $currentDay > $daysInMonth)
                                <td class="empty"></td>
                            @else
                                <td class="{{ $isToday && $currentDay == $today->day ? 'today' : '' }}">
                                    {{ $currentDay++ }}
                                </td>
                            @endif
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
</body>
</html>



@include('user.pages.microsites.includes.footer')