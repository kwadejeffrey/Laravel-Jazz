<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\TaskController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [App\Http\Controllers\Task\TaskController::class, 'index'])->name('task.index');

Route::get('task/store', [App\Http\Controllers\Task\TaskController::class, 'store'])->name('task.store');

Route::post('tasks/create', [App\Http\Controllers\Task\TaskController::class, 'create'])->name('task.create');

Route::post('/tasks/{id}/complete', [TaskController::class, 'markAsCompleted']);

