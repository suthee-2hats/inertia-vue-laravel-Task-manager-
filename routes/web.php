<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    //post request for show the tasks 
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
});

require __DIR__.'/settings.php';