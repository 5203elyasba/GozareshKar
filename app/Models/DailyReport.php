<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_date',
        'start_time',
        'end_time',
        'fixed_tasks',
        'variable_tasks',
    ];

    protected $casts = [
        'report_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'fixed_tasks' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
