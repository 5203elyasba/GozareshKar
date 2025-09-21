<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\TimeLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tasks', TaskController::class);

    Route::prefix('time-log')->name('timelog.')->group(function () {
        Route::get('/', [TimeLogController::class, 'index'])->name('index');
        Route::post('/clock-in', [TimeLogController::class, 'clockIn'])->name('clockIn');
        Route::post('/clock-out', [TimeLogController::class, 'clockOut'])->name('clockOut');
        Route::post('/start-break', [TimeLogController::class, 'startBreak'])->name('startBreak');
        Route::post('/end-break', [TimeLogController::class, 'endBreak'])->name('endBreak');
    });
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
});
