<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Task\TaskController;

Route::controller(TaskController::class)->prefix('my-tasks')->group(function () {
    Route::get('get-projects', 'getMyProjects')->name('admin.my-tasks.get-projects');
    Route::get('get-phase-by-project-id/{id}', 'getPhaseByProjectId')->name('admin.my-tasks.get-phase-by-project-id');
    Route::get('', 'indexMy')->name('admin.my-tasks.index');
});

