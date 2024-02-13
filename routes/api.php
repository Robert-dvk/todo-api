<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TasksController;

Route::group(['prefix' => 'V1'], function () {
    Route::apiResource('tasks', TasksController::class);
    Route::put('tasks/{task}/updatestatus', [TasksController::class, 'updateStatus']);
    Route::get('tasks/filter', [TasksController::class, 'filter']);
});