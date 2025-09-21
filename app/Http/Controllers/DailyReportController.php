<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Auth::user()->dailyReports()->latest('report_date')->paginate(15);
        return view('daily-reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::today()->toDateString();
        $report = Auth::user()->dailyReports()->where('report_date', $today)->first();

        if ($report) {
            return redirect()->route('daily-reports.edit', $report);
        }

        return view('daily-reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'variable_tasks' => 'nullable|string',
            // 'fixed_tasks' => 'nullable|array', // Add validation for fixed tasks later
        ]);

        DailyReport::create([
            'user_id' => Auth::id(),
            'report_date' => Carbon::today(),
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'variable_tasks' => $validatedData['variable_tasks'],
            // 'fixed_tasks' => $validatedData['fixed_tasks'],
        ]);

        return redirect()->route('daily-reports.index')->with('success', 'Daily report submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyReport $dailyReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyReport $dailyReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyReport $dailyReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyReport $dailyReport)
    {
        //
    }
}
