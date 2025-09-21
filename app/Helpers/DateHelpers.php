<?php

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

if (!function_exists('get_jalali_start_of_week')) {
    /**
     * Get the start of the Jalali week (Saturday) for a given date.
     *
     * @param Carbon $date
     * @return Carbon
     */
    function get_jalali_start_of_week(Carbon $date): Carbon
    {
        $jalaliDate = Jalalian::fromCarbon($date);
        // In morilog/jalali: Saturday is 0, Friday is 6
        $dayOfWeek = $jalaliDate->getDayOfWeek();
        return $jalaliDate->subDays($dayOfWeek)->toCarbon();
    }
}

if (!function_exists('get_jalali_start_of_month')) {
    /**
     * Get the start of the Jalali month for a given date.
     *
     * @param Carbon $date
     * @return Carbon
     */
    function get_jalali_start_of_month(Carbon $date): Carbon
    {
        return Jalalian::fromCarbon($date)->getFirstDayOfMonth()->toCarbon();
    }
}

if (!function_exists('jalali_date_format')) {
    /**
     * Converts a a date to a formatted Jalali date string with the day of the week.
     * e.g., "یکشنبه 1404/3/11"
     *
     * @param Carbon|string $date
     * @return string
     */
    function jalali_date_format($date): string
    {
        if (!$date instanceof Carbon) {
            $date = new Carbon($date);
        }

        return (new Jalalian($date->year, $date->month, $date->day))->format('%A %Y/%m/%d');
    }
}

if (!function_exists('jalali_workday')) {
    /**
     * Calculates the date after n working days, considering a weekend mask.
     *
     * @param Carbon|string $startDate
     * @param int $days
     * @param string $weekendMask 7-char string starting Monday, 1 = weekend. e.g., "0000110"
     * @return Carbon
     */
    function jalali_workday($startDate, int $days, string $weekendMask = '0000110'): Carbon
    {
        $currentDate = ($startDate instanceof Carbon) ? $startDate->copy() : new Carbon($startDate);
        $weekendMask = str_pad($weekendMask, 7, '0');
        $step = $days >= 0 ? 1 : -1;
        $remainingDays = abs($days);

        while ($remainingDays > 0) {
            $currentDate->addDays($step);

            // Carbon dayOfWeek: Sunday=0, Monday=1, ..., Saturday=6
            // Mask index: Monday=0, ..., Sunday=6
            $maskIndex = ($currentDate->dayOfWeek + 6) % 7;

            $isWeekend = $weekendMask[$maskIndex] === '1';

            if (!$isWeekend) {
                $remainingDays--;
            }
        }

        return $currentDate;
    }
}
