<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;

/*Route::apiResources([
    'projects' => ProjectController::class,
    'tasks' => TaskController::class,
]);*/

Route::apiResource('projects', ProjectController::class);
Route::apiResource('projects.tasks', TaskController::class)->shallow();

Route::get('/tasks', [TaskController::class,'index']);
