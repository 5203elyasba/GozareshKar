<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TimeLogController extends Controller
{
    public function index()
    {
        return view('timelog.index');
    }

    public function clockIn()
    {
        return $this->logTime('clock_in');
    }

    public function clockOut()
    {
        return $this->logTime('clock_out');
    }

    public function startBreak()
    {
        return $this->logTime('start_break');
    }

    public function endBreak()
    {
        return $this->logTime('end_break');
    }

    private function logTime(string $type)
    {
        // Basic validation could be added here to prevent duplicate entries
        // For example, a user cannot clock in if they are already clocked in.
        // For now, we will keep it simple.

        TimeLog::create([
            'user_id' => Auth::id(),
            'type' => $type,
            'log_time' => Carbon::now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Time logged successfully.']);
    }
}
