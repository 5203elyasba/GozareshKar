<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Weekly Stats
        $startOfWeek = get_jalali_start_of_week($today->copy());
        $endOfWeek = $startOfWeek->copy()->addDays(6);

        $weeklyReports = $user->dailyReports()
            ->whereBetween('report_date', [$startOfWeek, $endOfWeek])
            ->get();

        $weeklyMinutes = 0;
        foreach ($weeklyReports as $report) {
            if ($report->start_time && $report->end_time) {
                $startTime = Carbon::parse($report->start_time);
                $endTime = Carbon::parse($report->end_time);
                $weeklyMinutes += $endTime->diffInMinutes($startTime);
            }
        }
        $weeklyHours = floor($weeklyMinutes / 60);
        $weeklyRemainingMinutes = $weeklyMinutes % 60;

        // Monthly Stats
        $startOfMonth = get_jalali_start_of_month($today->copy());
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $monthlyReports = $user->dailyReports()
            ->whereBetween('report_date', [$startOfMonth, $endOfMonth])
            ->get();

        $monthlyMinutes = 0;
        foreach ($monthlyReports as $report) {
            if ($report->start_time && $report->end_time) {
                $startTime = Carbon::parse($report->start_time);
                $endTime = Carbon::parse($report->end_time);
                $monthlyMinutes += $endTime->diffInMinutes($startTime);
            }
        }
        $monthlyHours = floor($monthlyMinutes / 60);
        $monthlyRemainingMinutes = $monthlyMinutes % 60;

        // Today's stats
        $todaysReport = $weeklyReports->firstWhere('report_date', $today->toDateString());
        $todayMinutes = 0;
        if ($todaysReport && $todaysReport->start_time && $todaysReport->end_time) {
            $startTime = Carbon::parse($todaysReport->start_time);
            $endTime = Carbon::parse($todaysReport->end_time);
            $todayMinutes = $endTime->diffInMinutes($startTime);
        }
        $todayHours = floor($todayMinutes / 60);
        $todayRemainingMinutes = $todayMinutes % 60;

        $stats = [
            'today' => sprintf('%d ساعت و %d دقیقه', $todayHours, $todayRemainingMinutes),
            'week' => sprintf('%d ساعت و %d دقیقه', $weeklyHours, $weeklyRemainingMinutes),
            'month' => sprintf('%d ساعت و %d دقیقه', $monthlyHours, $monthlyRemainingMinutes),
            'reports_in_month' => $monthlyReports->count(),
        ];

        return view('dashboard', ['stats' => $stats]);
    }
}
