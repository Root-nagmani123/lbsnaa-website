

    <?php echo $__env->make('user.pages.microsites.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/calendar.css')); ?>">
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
            <a href="<?php echo e(route('calendar', ['month' => $month - 1, 'year' => $year])); ?>">&lt;&lt;</a>
            <select onchange="window.location.href = this.value">
                <?php for($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo e(route('calendar', ['month' => $i, 'year' => $year])); ?>" <?php echo e($i == $month ? 'selected' : ''); ?>>
                        <?php echo e(\Carbon\Carbon::createFromDate(null, $i, 1)->format('F')); ?>

                    </option>
                <?php endfor; ?>
            </select>
            <select onchange="window.location.href = this.value">
                <?php for($i = 2020; $i <= 2030; $i++): ?>
                    <option value="<?php echo e(route('calendar', ['month' => $month, 'year' => $i])); ?>" <?php echo e($i == $year ? 'selected' : ''); ?>>
                        <?php echo e($i); ?>

                    </option>
                <?php endfor; ?>
            </select>
            <a href="<?php echo e(route('calendar', ['month' => $month + 1, 'year' => $year])); ?>">&gt;&gt;</a>

            <!-- Clear Button -->
            <button onclick="window.location.href = '<?php echo e(route('calendar')); ?>'">Clear</button>
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
                <?php
                    $currentDay = 1;
                    $today = \Carbon\Carbon::now();
                    $isToday = $today->format('Y-m') === "$year-$month";
                ?>
                <?php for($i = 0; $i < ceil(($daysInMonth + $startDay) / 7); $i++): ?>
                    <tr>
                        <?php for($j = 0; $j < 7; $j++): ?>
                            <?php if(($i === 0 && $j < $startDay) || $currentDay > $daysInMonth): ?>
                                <td class="empty"></td>
                            <?php else: ?>
                                <td class="<?php echo e($isToday && $currentDay == $today->day ? 'today' : ''); ?>">
                                    <?php echo e($currentDay++); ?>

                                </td>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</body>
</html>



<?php echo $__env->make('user.pages.microsites.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lbsnaa-website\resources\views/user/pages/microsites/calendar.blade.php ENDPATH**/ ?>